<?php

namespace App\Repositories\Interfaces;

use App\Models\Parcel;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface ParcelRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllParcels(array $filters = []): LengthAwarePaginator;

    /**
     * @param string $id
     * @return Parcel|null
     */
    public function findParcelById(string $id): ?Parcel;

    /**
     * @param array $data
     * @return Parcel
     */
    public function createParcel(array $data): Parcel;

    /**
     * @param Parcel $parcel
     * @param array $data
     * @return Parcel
     */
    public function updateParcel(Parcel $parcel, array $data): Parcel;

    /**
     * @param Parcel $parcel
     * @return void
     */
    public function deleteParcel(Parcel $parcel): void;
}
