<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Country\StoreRequest;
use App\Http\Requests\Admin\Country\UpdateRequest;
use App\Services\CountryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private CountryService $countryService;

    public function __construct(CountryService $countryService)
    {
        $this->countryService = $countryService;
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): JsonResponse
    {
        $filters = [
            'title' => $request->input('title'),
            'delivery_status' => $request->input('delivery_status'),
        ];

        $countries = $this->countryService->getAllCountries($filters);

        return response()->json($countries);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $country = $this->countryService->createCountry($request->validated());

        return response()->json([
            'id' => $country->id,
            'message' => 'Country created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $country = $this->countryService->findCountryById($id);

        return $country
            ? response()->json($country)
            : response()->json(['message' => 'Country not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $country = $this->countryService->updateCountry($id, $request->validated());

            return response()->json($country);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Country not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->countryService->deleteCountry($id);
            return response()->json(['message' => 'Country deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Country not found'], 404);
        }
    }
}
