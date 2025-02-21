<?php

namespace App\Repositories\Interfaces;

use App\Models\Tariff;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface TariffRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllTariffs(array $filters = []): LengthAwarePaginator;

    /**
     * @param string $id
     * @return Tariff|null
     */
    public function findTariffById(string $id): ?Tariff;

    /**
     * @param array $data
     * @return Tariff
     */
    public function createTariff(array $data): Tariff;

    /**
     * @param Tariff $tariff
     * @param array $data
     * @return Tariff
     */
    public function updateTariff(Tariff $tariff, array $data): Tariff;

    /**
     * @param Tariff $tariff
     * @return void
     */
    public function deleteTariff(Tariff $tariff): void;
}
