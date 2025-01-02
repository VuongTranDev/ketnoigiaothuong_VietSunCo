<?php

namespace App\Services;

use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Companies;

class AddressService
{
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

    public function showAddressByIdCompany($id)
    {
        // Lấy công ty kèm danh sách địa chỉ
        $company = Companies::where('user_id', $id)->with('addresses')->first();
        if (!$company) {
            return response()->json(['status' => 'error', 'message' => 'Company not found'], 404);
        }
        return $company->addresses;

    }


    /**
     * Summary of validateData
     * @param Request $request
     * @return array
     */
    public function formatData($addresses)
    {
        \Log::info('address: ' . json_encode($addresses));

        // Kiểm tra nếu `$addresses` là mảng
        if (!is_array($addresses) && !$addresses instanceof \Illuminate\Support\Collection) {
            return [];
        }

        // Xử lý từng địa chỉ
        $formattedData = [];
        foreach ($addresses as $address) {
            $formattedData[] = [
                'id' => $address->id,
                'details' => $address->details,
                'address' => $address->address,
                'company_id' => $address->companies, // Hoặc sử dụng $address->companies->id nếu muốn lấy ID từ quan hệ
                'created_at' => $address->created_at,
                'updated_at' => $address->updated_at
            ];
        }

        return $formattedData;
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
        $companies = Companies::where('user_id', $request->company_id)->first();
        return Address::create([
            'details' => $request->details,
            'address' => $request->address,
            'company_id' => $companies->id
        ]);
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
