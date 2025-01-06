<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Models\Message;
use App\Models\Users;
use Illuminate\Support\Facades\Log;
use App\Mail\TransactionCreated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use App\Events\MessageSent;
use Carbon\Carbon;
use Mail;

class MessageController extends Controller
{
    public function getUser($id)
    {
        $messages = Message::with(['senderUser.companies', 'receiverUser.companies'])
            ->select('sender_id', 'receiver_id', 'status')
            ->where(function ($query) use ($id) {
                $query->where('sender_id', $id)
                      ->orWhere('receiver_id', $id);
            })
            ->get();

        $partners = $messages->flatMap(function ($message) use ($id) {
            $partner = $message->sender_id == $id ? $message->receiverUser : $message->senderUser;

            if (!$partner || $partner->companies->isEmpty()) {
                Log::info('Partner skipped due to empty companies or null:', ['message_id' => $message->id]);
                return [];
            }

            $hasSentMessage = Message::where('sender_id', $partner->id)
                ->where('receiver_id', $id)
                ->where('status', 'sent')
                ->exists();

            Log::info('Partner found:', [
                'partner_id' => $partner->id,
                'hasSentMessage' => $hasSentMessage,
            ]);

            return $partner->companies->map(function ($company) use ($partner, $hasSentMessage) {
                return [
                    'id' => $partner->id,
                    'name' => $company->representative,
                    'image' => $company->image,
                    'email' => $partner->email,
                    'hasSentMessage' => $hasSentMessage
                ];
            });
        });

        Log::info('Partners retrieved:', $partners->toArray());

        $uniquePartners = $partners->unique(function ($item) {
            return $item['id'] . '-' . $item['name'];
        })->values();

        Log::info('Unique partners:', $uniquePartners->toArray());

        return response()->json($uniquePartners, 200);
    }

    public function sendMessage(Request $request)
    {
        $request->validate([
            'receiver_id' => 'required|exists:users,id',
            'content' => 'required|string',
        ]);

        $message = Message::create([
            'sender_id' => Auth::id(),
            'receiver_id' => $request->receiver_id,
            'content' => $request->content,
            'status' => 'sent',
        ]);

        broadcast(new MessageSent($message->content, $request->receiver_id, Carbon::now(), Auth::id()))->toOthers();

        return response()->json([
            'message' => 'Message sent successfully',
            'data' => $message,
        ], 201);
    }

    public function getMessages($userId)
    {
        $messages = Message::where(function ($query) use ($userId) {
            $query->where('sender_id', Auth::id())
                ->where('receiver_id', $userId);
        })->orWhere(function ($query) use ($userId) {
            $query->where('sender_id', $userId)
                ->where('receiver_id', Auth::id());
        })->orderBy('created_at', 'asc')->get();

        return response()->json($messages->unique('id'), 200);
    }

    public function markAllAsRead($receiverId)
    {
        Message::where('receiver_id', Auth::id())
            ->where('sender_id', $receiverId)
            ->where('status', 'sent')
            ->update(['status' => 'read']);

        return response()->json([
            'status' => 'success',
            'message' => 'All messages from the sender marked as read.',
        ]);
    }
    public function getCompanyByUser(Request $request)
    {
        $request->validate([
            'company_a' => 'required|integer',
            'company_b' => 'required|integer',
        ]);

        $userA = Users::find($request->company_a);
        $userB = Users::find($request->company_b);

        if (!$userA || !$userB) {
            return response()->json(['status' => 'error', 'message' => 'One or both users not found.'], 404);
        }

        $companyA = $userA->companies;
        $companyB = $userB->companies;

        if (!$companyA || !$companyB) {
            return response()->json(['status' => 'error', 'message' => 'One or both companies not found.'], 404);
        }

        return response()->json([
            'status' => 'success',
            'data' => [
                'company_a' => $companyA,
                'company_b' => $companyB,
            ],
        ], 200);
    }
    public function createTransaction(Request $request)
    {
        $transaction = new Transaction();
        $transaction->sender_id  = Auth::id();
        $transaction->receiver_id = $request->receiver_id;
        $transaction->title = $request->title;
        $transaction->content = $request->content;
        $transaction->date_meet = $request->date_meet;
        $transaction->address = $request->address;

        try {
            $transaction->save();
            $receiver = Users::find($request->receiver_id);
            \Log::info('receiver: ' . $receiver);
            if ($receiver) {
                Mail::to($receiver->email)->send(new TransactionCreated($transaction));
            }

            return response()->json([
                'status' => 'success',
                'data' => $transaction,
                'message' => 'Tạo cuộc hẹn thành công.',
            ], 200);
        } catch (\Exception $e) {
            \Log::error('Error in createTransaction: ' . $e->getMessage());
            return response()->json([
                'status' => 'error',
                'message' => 'An error occurred while saving the transaction.',
            ], 500);
        }
    }
    public function getTransaction($receiver_id)
    {
        $transaction = Transaction::select(
            'transaction.*',
            'companies_sender.representative as company_sender_name',
            'companies_receiver.representative as company_receiver_name',
            'companies_sender.company_name as company_sender_company_name',
            'companies_receiver.company_name as company_receiver_company_name',
            'sender.id as sender_id',
            'sender.email as sender_email',
            'receiver.id as receiver_id',
            'receiver.name as receiver_name',
            'receiver.email as receiver_email'
        )
            ->join('users as sender', 'sender.id', '=', 'transaction.sender_id')
            ->join('users as receiver', 'receiver.id', '=', 'transaction.receiver_id')
            ->join('companies as companies_sender', 'companies_sender.user_id', '=', 'transaction.sender_id')
            ->join('companies as companies_receiver', 'companies_receiver.user_id', '=', 'transaction.receiver_id')
            ->where('transaction.sender_id', Auth::id())
            ->where('transaction.receiver_id', $receiver_id)
            ->get();
        if ($transaction->isNotEmpty()) {
            return response()->json([
                'status' => 'success',
                'data' => $transaction,
            ], 200);
        }

        return response()->json([
            'status' => 'error',
            'message' => 'No pending transaction found.',
        ], 404);
    }
}
