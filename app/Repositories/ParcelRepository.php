<?php

namespace App\Repositories;

use App\Models\Parcel;
use App\Repositories\Interfaces\ParcelRepositoryInterface;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ParcelRepository implements ParcelRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllParcels(array $filters = []): LengthAwarePaginator
    {
        $parcels = Parcel::query()->with([
            'warehouse' => function ($query) {
                $query->select('id','title');
            },
            'branch' => function ($query) {
                $query->select('id','title');
            },
        ]);

        return $parcels->paginate(10);
    }

    /**
     * @param string $id
     * @return Parcel|null
     */
    public function findParcelById(string $id): ?Parcel
    {
        return Parcel::query()->with([
            'warehouse' => function ($query) {
                $query->select('id','title');
            },
            'branch' => function ($query) {
                $query->select('id','title');
            },
        ])->findOrFail($id);
    }

    /**
     * @param array $data
     * @return Parcel
     */
    public function createParcel(array $data): Parcel
    {
        return Parcel::create($data);
    }

    /**
     * @param Parcel $parcel
     * @param array $data
     * @return Parcel
     */
    public function updateParcel(Parcel $parcel, array $data): Parcel
    {
        $parcel->update($data);
        return $parcel;
    }

    /**
     * @param Parcel $parcel
     * @return void
     */
    public function deleteParcel(Parcel $parcel): void
    {
        $parcel->delete();
    }
}
