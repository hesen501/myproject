<?php

namespace App\Repositories\Interfaces;

use App\Models\Warehouse;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

interface WarehouseRepositoryInterface
{
    /**
     * Retrieve all warehouses with relations.
     *
     * @return LengthAwarePaginator
     */
    public function getAllWarehousesWithRelations(): LengthAwarePaginator;

    /**
     * Create a new warehouse.
     *
     * @param array $data
     * @return Warehouse
     */
    public function create(array $data): Warehouse;

    /**
     * Update an existing warehouse.
     *
     * @param Warehouse $warehouse
     * @param array $data
     * @return Warehouse
     */
    public function update(Warehouse $warehouse, array $data): Warehouse;

    /**
     * Delete a warehouse by ID.
     *
     * @param string $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function delete(string $id): void;

    /**
     * Find a warehouse by ID, including related city translations.
     *
     * @param string $id
     * @return Warehouse|null
     */
    public function findById(string $id): ?Warehouse;
}
