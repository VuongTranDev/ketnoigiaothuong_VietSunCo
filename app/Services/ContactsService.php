<?php

namespace App\Services;

use App\Models\Contacts;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ContactsService
{
    /**
     * Summary of create
     * @param Request $request
     * @return Contacts
     */
    public function create($request) {
        return Contacts::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'message' => $request->message
        ]);
    }

    /**
     * Summary of validate
     * @param mixed $request
     * @return \Illuminate\Validation\Validator
     */
    public function validate($request) {
        return Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);
    }

    /**
     * Summary of show
     * @param mixed $page
     * @param mixed $limit
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function show($page, $limit)
    {
        return Contacts::query()
            ->orderBy('id', 'desc')
            ->paginate($limit, ['*'], 'page', $page);
    }

    /**
     * Summary of formatPaginate
     * @param mixed $contact
     * @return array
     */
    public function formatPaginate($contact)
    {
        return [
            'current_page' => $contact->currentPage(),
            'total_page' => $contact->lastPage(),
            'total_items' => $contact->total(),
            'items_per_page' => $contact->perPage()
        ];
    }
    public function formatData($contact)
    {
        return [
            'id' => $contact->id,
            'name' => $contact->name,
            'email' => $contact->email,
            'phone' => $contact->phone,
            'message' => $contact->message,
            'status' => $contact->status,
        ];
    }
}
