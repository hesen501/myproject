<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\City\StoreRequest;
use App\Http\Requests\Admin\City\UpdateRequest;
use App\Services\CityService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CityController extends Controller
{
    private CityService $cityService;

    public function __construct(CityService $cityService)
    {
        $this->cityService = $cityService;
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

        $cities = $this->cityService->getAllCities($filters);

        return response()->json($cities);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $city = $this->cityService->createCity($request->validated());

        return response()->json([
            'id' => $city->id,
            'message' => 'City created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $city = $this->cityService->findCityById($id);

        if ($city) {
            return response()->json($city);
        }

        return response()->json(['message' => 'City not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $city = $this->cityService->updateCity($id, $request->validated());
            return response()->json($city);
        } catch (\Exception $e) {
            return response()->json(['message' => 'City not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->cityService->deleteCity($id);
            return response()->json(['message' => 'City deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'City not found'], 404);
        }
    }
}
