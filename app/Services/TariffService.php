<?php

namespace App\Services;

use App\Models\Tariff;
use App\Repositories\TariffRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TariffService
{
    private TariffRepository $tariffRepository;

    public function __construct(TariffRepository $tariffRepository)
    {
        $this->tariffRepository = $tariffRepository;
    }

    public function createTariff(array $data): Tariff
    {
        return $this->tariffRepository->createTariff($data);
    }

    public function updateTariff(string $id, array $data): Tariff
    {
        $tariff = $this->tariffRepository->findTariffById($id);
        if (!$tariff) {
            throw new ModelNotFoundException('Tariff not found');
        }

        return $this->tariffRepository->updateTariff($tariff, $data);
    }

    public function deleteTariff(string $id): void
    {
        $tariff = $this->tariffRepository->findTariffById($id);
        if (!$tariff) {
            throw new ModelNotFoundException('Tariff not found');
        }

        $this->tariffRepository->deleteTariff($tariff);
    }

    public function findTariffById(string $id): ?Tariff
    {
        return $this->tariffRepository->findTariffById($id);
    }

    public function getAllTariffs(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->tariffRepository->getAllTariffs($filters);
    }
}
