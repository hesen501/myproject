<?php

namespace App\Services;

use App\Repositories\WarehouseRepository;
use App\Models\Warehouse;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WarehouseService
{
    private WarehouseRepository $warehouseRepository;

    public function __construct(WarehouseRepository $warehouseRepository)
    {
        $this->warehouseRepository = $warehouseRepository;
    }

    /**
     * Retrieve warehouses with related cities, regions, and countries.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getWarehousesWithRelations()
    {
        $warehouses = $this->warehouseRepository->getAllWarehousesWithRelations();

        foreach ($warehouses as $warehouse) {
            // Handle city translations
            $cityTranslation = $warehouse->city->translations->first();
            $warehouse->city->title = $cityTranslation ? $cityTranslation->title : 'No translation found';
            unset($warehouse->city->translations);

            // Handle region translations
            $regionTranslation = $warehouse->region->translations->first();
            $warehouse->region->title = $regionTranslation ? $regionTranslation->title : 'No translation found';
            unset($warehouse->region->translations);
        }

        return $warehouses;
    }

    /**
     * Create a new warehouse.
     *
     * @param array $data
     * @return Warehouse
     */
    public function createWarehouse(array $data): Warehouse
    {
        return $this->warehouseRepository->create($data);
    }

    /**
     * Update an existing warehouse.
     *
     * @param Warehouse $warehouse
     * @param array $data
     * @return Warehouse
     */
    public function updateWarehouse(Warehouse $warehouse, array $data): Warehouse
    {
        return $this->warehouseRepository->update($warehouse, $data);
    }

    /**
     * Delete a warehouse by ID.
     *
     * @param string $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function deleteWarehouse(string $id): void
    {
        $this->warehouseRepository->delete($id);
    }

    /**
     * Find a warehouse by ID, including related city translations.
     *
     * @param string $id
     * @return Warehouse|null
     */
    public function findWarehouseById(string $id): ?Warehouse
    {
        $warehouse = $this->warehouseRepository->findById($id);

        if ($warehouse){
            $warehouse->region->title = $warehouse->region->translations->first()->title;
            unset($warehouse->region->translations);
            $warehouse->city->title = $warehouse->city->translations->first()->title;
            unset($warehouse->city->translations);
        }

        return $warehouse;
    }
}
