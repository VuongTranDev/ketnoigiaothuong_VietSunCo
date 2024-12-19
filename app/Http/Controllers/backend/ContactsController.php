<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Mail\SendContactMail;
use App\Models\Contacts;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsController extends Controller
{
    protected $client;
    public function __construct(Client $client)
    {
        $this->client = $client;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $url = env('API_URL') . "send-contact";
        $response = $this->client->request('GET', $url);
        $data = json_decode($response->getBody());
        return view('frontend.admin.contacts.index')->with('data', $data);
    }

    public function sendBulkEmail(Request $request)
    {
        $validated = $request->validate([
            'subject' => 'required|string|max:255',
            'message' => 'required|string'
        ]);

        $contacts = Contacts::where('status', 0)->get();

        foreach ($contacts as $contact) {
            try {
                Mail::to($contact->email)->send(new SendContactMail($validated['subject'], $validated['message']));

                $contact->status = 1;
                $contact->save();
            } catch (\Exception $e) {
                \Log::error("Failed to send email to {$contact->email}: " . $e->getMessage());
            }
        }

        return redirect()->back()->with('success', 'Gửi email thành công!');
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
