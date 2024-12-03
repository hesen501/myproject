<?php

namespace App\Repositories;

use App\Models\Tariff;

class TariffRepository
{
    /**
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllTariffs(array $filters = [])
    {
        $tariffs = Tariff::query()->with([
            'country' => function ($query) {
                $query->select('id','title');
            }
        ]);

        return $tariffs->paginate(10);
    }

    /**
     * @param string $id
     * @return Tariff|null
     */
    public function findTariffById(string $id): ?Tariff
    {
        return Tariff::query()->with([
            'country' => function ($query) {
                $query->select('id','title');
            },

        ])->find($id);
    }

    /**
     * @param array $data
     * @return Tariff
     */
    public function createTariff(array $data): Tariff
    {
        return Tariff::create($data);
    }

    /**
     * @param Tariff $tariff
     * @param array $data
     * @return Tariff
     */
    public function updateTariff(Tariff $tariff, array $data): Tariff
    {
        $tariff->update($data);
        return $tariff;
    }

    /**
     * @param Tariff $tariff
     * @return void
     */
    public function deleteTariff(Tariff $tariff): void
    {
        $tariff->delete();
    }
}
