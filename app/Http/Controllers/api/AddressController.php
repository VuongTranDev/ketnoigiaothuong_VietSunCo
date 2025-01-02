<?php

namespace App\Http\Controllers\api;

use App\Models\Address;
use App\Models\Districts;
use App\Models\Wards;
use App\Services\AddressService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpFoundation\Response;

class AddressController extends BaseController
{
    public $addressService;

    public function __construct(AddressService $addressService)
    {
        $this->addressService = $addressService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        try {
            $address = $this->addressService->show($request);

            if ($address->isEmpty()) {
                return $this->failed('No addresses found', 404);
            }

            return $this->success(
                $address->map(fn($addr) => $this->addressService->formatData($addr)),
                'Addresses retrieved successfully',
                200
            );
        } catch (\Exception $e) {
            return $this->exception('An error occurred while retrieving addresses', $e->getMessage(), 500);
        }
    }


    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        \Log::info('request: ' . json_encode($request->all()));
        try {
            $validator = $this->addressService->validateData($request);

            if ($validator->fails()) {
                return $this->failed($validator->errors(), 422);
            }

            $address = $this->addressService->create($request);

            return $this->success($this->addressService->formatData($address), 'Address created successfully', 201);
        } catch (\Exception $e) {
            return $this->exception('An error occurred while creating address', $e->getMessage(), 500);
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $address = $this->addressService->showById($id);

            if ($address == null) {
                return $this->failed('Address not found', 404);
            }

            return $this->success($this->addressService->formatData($address), 'address retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->exception('an error occurred while retrieving address', $e->getMessage(), 500);
        }
    }

    public function showAddressByIdCompany($id) {

        try {
            $address = $this->addressService->showAddressByIdCompany($id);

            if ($address == null) {
                return $this->failed('Address not found', 404);
            }

            return $this->success($this->addressService->formatData($address), 'address retrieved successfully', 200);
        } catch (\Exception $e) {
            return $this->exception('an error occurred while retrieving address', $e->getMessage(), 500);
        }
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $validator = $this->addressService->validateData($request);

            if ($validator->fails()) {
                return $this->failed($validator->errors(), 422);
            }

            $address = $this->addressService->update($request, $id);

            return $this->success($this->addressService->formatData($address),  'Address updated successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('Address not found!', 422);
        } catch (\Exception $e) {
            return $this->exception('An error occurred', $e->getMessage(), 500);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $this->addressService->delete($id);
            return $this->success([],  'Address deleted successfully', 200);
        } catch (ModelNotFoundException $e) {
            return $this->failed('Address not found', 404);
        } catch (\Exception $e) {
            return $this->exception('An error occurred', $e->getMessage(), 500);
        }
    }
    public function getDistricts($provinceId)
    {
        $districts = Districts::where('province_id', $provinceId)->get();

        if ($districts->isEmpty()) {
            return response()->json([], 200);
        }

        return response()->json($districts, 200);
    }

    public function getWards($districtId)
    {
        $wards = Wards::where('district_id', $districtId)->get();

        if ($wards->isEmpty()) {
            return response()->json([], 200);
        }

        return response()->json($wards, 200);
    }
}
