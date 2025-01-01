<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressService {
    /**
     * Retrieve all address data.
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Database\Eloquent\Builder[]|\Illuminate\Database\Eloquent\Collection
     */
    public function show(Request $request)
    {
        return Address::with('companies')->get();
    }

    /**
     * Retrieve address by its id.
     * @param int $id
     * @return Address|Address[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model
     */
    public function showById($id)
    {
        return Address::with('companies')->find($id);
    }

    public function showAddressByIdCompany($id) {
        return Address::where('company_id', $id)->with('companies')->first();
    }

    /**
     * Summary of validateData
     * @param Request $request
     * @return array
     */
    public function formatData($address)
    {
        return [
            'id' => $address->id,
            'details' => $address->details,
            'address' => $address->address,
            'company_id' => $address->companies,
            'created_at' => $address->created_at,
            'updated_at' => $address->updated_at
        ];
    }

    /**
     * Create a new address record in the database.
     * @param Request $request
     * @return \Illuminate\Validation\Validator
     */
    public function validateData($request)
    {
        return Validator::make($request->all(), [
            'details' => 'required|string',
            'address' => 'required|string',
            'company_id' => 'required|integer',
        ]);
    }

    /**
     * Create a new address record in the database.
     * @param Request $request
     * @return Address|\Illuminate\Database\Eloquent\Model
     */
    public function create($request)
    {
        return Address::create($request->only('details', 'address', 'company_id'));
    }

    

    /**
     * Update an existing address record in the database by its ID.
     * @param Request $request
     * @param int $id
     * @return Address|Address[]|\Illuminate\Database\Eloquent\Collection|\Illuminate\Database\Eloquent\Model|null
     */
    public function update($request, $id)
    {
        $address = Address::findOrFail($id);
        $address->update($request->only('details', 'address', 'company_id'));
        return $address;
    }

    /**
     * Delete a address record from the database by its ID.
     * @param int $id
     * @return Address
     * @throws \Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function delete($id)
    {
        $address = Address::findOrFail($id);
        $address->delete();
        return $address;
    }
}
