<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use App\Mail\SendContactMail;
use App\Models\Contacts;
use App\Services\ContactsService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactsApiController extends BaseController
{
    public $contactsService;

    public function __construct(ContactsService $contactsService)
    {
        $this->contactsService = $contactsService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $limit = $request->input('limit', 12);
            $page = $request->input('page', 1);

            $data = $this->contactsService->show($page, $limit);

            $formattedData = collect($data->items())->map(function ($item) {
                return $this->contactsService->formatData($item);
            })->toArray();

            $formattedPagination = $this->contactsService->formatPaginate($data);

            return $this->successWithPagination(
                $formattedPagination,
                $formattedData,
                200,
            );
        } catch (ModelNotFoundException $e) {
            return $this->failed('Contact not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving contact', $e->getMessage(), 500);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = $this->contactsService->validate($request);

        if ($validator->fails()) {
            return $this->failed($validator->errors(), 400);
        }

        $contacts = $this->contactsService->create($request);

        return $this->success($contacts, 'contacts created successfully', 201);
    }

    /**
     * Display the specified resource.
     */
    
}
