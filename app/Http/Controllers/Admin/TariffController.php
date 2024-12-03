<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Tariff\StoreRequest;
use App\Http\Requests\Admin\Tariff\UpdateRequest;
use App\Services\TariffService;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class TariffController extends Controller
{
    private TariffService $tariffService;

    public function __construct(TariffService $tariffService)
    {
        $this->tariffService = $tariffService;
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

        $tariffs = $this->tariffService->getAllTariffs($filters);

        return response()->json($tariffs);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $tariff = $this->tariffService->createTariff($request->validated());

        return response()->json([
            'id' => $tariff->id,
            'message' => 'Tariff created successfully',
        ], 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id): JsonResponse
    {
        $tariff = $this->tariffService->findTariffById($id);

        return $tariff
            ? response()->json($tariff)
            : response()->json(['message' => 'Tariff not found'], 404);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        try {
            $tariff = $this->tariffService->updateTariff($id, $request->validated());
            return response()->json($tariff);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tariff not found'], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->tariffService->deleteTariff($id);
            return response()->json(['message' => 'Tariff deleted successfully'], 204);
        } catch (ModelNotFoundException $e) {
            return response()->json(['message' => 'Tariff not found'], 404);
        } catch (\Exception $e) {
            return response()->json(['message' => 'An error occurred while deleting the tariff'], 500);
        }
    }
}
