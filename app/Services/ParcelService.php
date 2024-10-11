<?php

namespace App\Services;

use App\Models\Parcel;
use App\Repositories\ParcelRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class ParcelService
{
    private ParcelRepository $parcelRepository;

    public function __construct(ParcelRepository $parcelRepository)
    {
        $this->parcelRepository = $parcelRepository;
    }

    public function createParcel(array $data): Parcel
    {
        return $this->parcelRepository->createParcel($data);
    }

    public function updateParcel(string $id, array $data): Parcel
    {
        $parcel = $this->parcelRepository->findParcelById($id);
        if (!$parcel) {
            throw new ModelNotFoundException('Parcel not found');
        }

        return $this->parcelRepository->updateParcel($parcel, $data);
    }

    public function deleteParcel(string $id): void
    {
        $parcel = $this->parcelRepository->findParcelById($id);
        if (!$parcel) {
            throw new ModelNotFoundException('Parcel not found');
        }

        $this->parcelRepository->deleteParcel($parcel);
    }

    public function findParcelById(string $id): ?Parcel
    {
        return $this->parcelRepository->findParcelById($id);
    }

    public function getAllParcels(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->parcelRepository->getAllParcels($filters);
    }
}
