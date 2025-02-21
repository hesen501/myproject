<?php

namespace App\Repositories;

use App\Models\Warehouse;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class WarehouseRepository implements WarehouseRepositoryInterface
{
    /**
     * Retrieve all warehouses with relations.
     *
     * @return LengthAwarePaginator
     */
    public function getAllWarehousesWithRelations(): LengthAwarePaginator
    {
        return Warehouse::query()->with([
            'city.translations' => function ($query) {
                $query->select('city_id', 'title')->where('locale', 'en');
            },
            'city' => function ($query) {
                $query->select('id');
            },
            'region.translations' => function ($query) {
                $query->select('region_id', 'title')->where('locale', 'en');
            },
            'region' => function ($query) {
                $query->select('id');
            },
            'country' => function ($query) {
                $query->select('id', 'title');
            },
        ])->paginate(10);
    }

    /**
     * Create a new warehouse.
     *
     * @param array $data
     * @return Warehouse
     */
    public function create(array $data): Warehouse
    {
        return Warehouse::query()->create($data);
    }

    /**
     * Update an existing warehouse.
     *
     * @param Warehouse $warehouse
     * @param array $data
     * @return Warehouse
     */
    public function update(Warehouse $warehouse, array $data): Warehouse
    {
        $warehouse->update($data);
        return $warehouse;
    }

    /**
     * Delete a warehouse by ID.
     *
     * @param string $id
     * @return void
     * @throws ModelNotFoundException
     */
    public function delete(string $id): void
    {
        $warehouse = Warehouse::query()->findOrFail($id); // Use findOrFail for automatic exception handling
        $warehouse->delete();
    }

    /**
     * Find a warehouse by ID, including related city translations.
     *
     * @param string $id
     * @return Warehouse|null
     */
    public function findById(string $id): ?Warehouse
    {
        return Warehouse::query()->with([
            'city.translations' => function ($query) {
                $query->where('locale', 'en');
            },
            'city' => function ($query) {
                $query->select('id');
            },
            'region.translations' => function ($query) {
                $query->where('locale', 'en');
            },
            'region' => function ($query) {
                $query->select('id');
            },
            'country' => function ($query) {
                $query->select('id','title');
            },
        ])->findOrFail($id);
    }
}
