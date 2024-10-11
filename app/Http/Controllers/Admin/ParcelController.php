<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Parcel\StoreRequest;
use App\Http\Requests\Admin\Parcel\UpdateRequest;
use App\Services\ParcelService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class ParcelController extends Controller
{
    private ParcelService $parcelService;

    public function __construct(ParcelService $parcelService)
    {
        $this->parcelService = $parcelService;
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

        $parcels = $this->parcelService->getAllParcels($filters);

        return response()->json($parcels);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $parcel = $this->parcelService->createParcel($request->validated());

        return response()->json([
            'id' => $parcel->id,
            'message' => 'Parcel created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $parcel = $this->parcelService->findParcelById($id);

        return $parcel
            ? response()->json($parcel)
            : response()->json(['message' => 'Parcel not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $parcel = $this->parcelService->updateParcel($id, $request->validated());
            return response()->json($parcel);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Parcel not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->parcelService->deleteParcel($id);
            return response()->json(['message' => 'Parcel deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Parcel not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the parcel'], 500);
        }
    }
}
