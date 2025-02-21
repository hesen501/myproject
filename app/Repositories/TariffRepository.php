<?php

namespace App\Repositories;

use App\Models\Tariff;
use App\Repositories\Interfaces\TariffRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class TariffRepository implements TariffRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllTariffs(array $filters = []): LengthAwarePaginator
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
        ])->findOrFail($id);
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
