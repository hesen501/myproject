<?php

namespace App\Repositories;

use App\Models\Parcel;

class ParcelRepository
{
    public function getAllParcels(array $filters = [])
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

    public function findParcelById(string $id): ?Parcel
    {
        return Parcel::query()->with([
            'warehouse' => function ($query) {
                $query->select('id','title');
            },
            'branch' => function ($query) {
                $query->select('id','title');
            },
        ])->find($id);
    }

    public function createParcel(array $data): Parcel
    {
        return Parcel::create($data);
    }

    public function updateParcel(Parcel $parcel, array $data): Parcel
    {
        $parcel->update($data);
        return $parcel;
    }

    public function deleteParcel(Parcel $parcel): void
    {
        $parcel->delete();
    }
}
