<?php

namespace App\Http\Controllers\Admin;

use App\Http\Requests\Admin\Branch\UpdateRequest;
use App\Http\Requests\Admin\Warehouse\StoreRequest;
use App\Services\WarehouseService;
use App\Http\Controllers\Controller;
use Illuminate\Http\JsonResponse;

class WarehouseController extends Controller
{
    private WarehouseService $warehouseService;

    public function __construct(WarehouseService $warehouseService)
    {
        $this->warehouseService = $warehouseService;
    }

    /**
     * Display a listing of the warehouses.
     *
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $warehouses = $this->warehouseService->getWarehousesWithRelations();
        return response()->json($warehouses);
    }

    /**
     * Store a newly created warehouse in storage.
     *
     * @param StoreRequest $request
     * @return JsonResponse
     */
    public function store(StoreRequest $request): JsonResponse
    {
        $warehouse = $this->warehouseService->createWarehouse($request->validated());

        return response()->json([
            'id' => $warehouse->id,
            'message' => 'Warehouse created successfully',
        ], 201);
    }

    /**
     * Display the specified warehouse.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function show(string $id): JsonResponse
    {
        $warehouse = $this->warehouseService->findWarehouseById($id);

        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }

        return response()->json($warehouse);
    }

    /**
     * Update the specified warehouse in storage.
     *
     * @param UpdateRequest $request
     * @param string $id
     * @return JsonResponse
     */
    public function update(UpdateRequest $request, string $id): JsonResponse
    {
        $warehouse = $this->warehouseService->findWarehouseById($id);

        if (!$warehouse) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }

        $updatedWarehouse = $this->warehouseService->updateWarehouse($warehouse, $request->validated());

        return response()->json($updatedWarehouse);
    }

    /**
     * Remove the specified warehouse from storage.
     *
     * @param string $id
     * @return JsonResponse
     */
    public function destroy(string $id): JsonResponse
    {
        try {
            $this->warehouseService->deleteWarehouse($id);
            return response()->json(['message' => 'Warehouse deleted successfully'], 204);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Warehouse not found'], 404);
        }
    }
}
