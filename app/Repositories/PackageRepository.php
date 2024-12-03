<?php

namespace App\Repositories;

use App\Models\Package;

class PackageRepository
{
    /**
     * @param array $filters
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function getAllPackages(array $filters = [])
    {
        $packages = Package::query()->with([
            'warehouse' => function ($query) {
                $query->select('id','title');
            },
            'branch' => function ($query) {
                $query->select('id','title');
            },
        ]);

        return $packages->paginate(10);
    }

    /**
     * @param string $id
     * @return Package|null
     */
    public function findPackageById(string $id): ?Package
    {
        return Package::query()->with([
            'user'
        ])->find($id);
    }

    /**
     * @param array $data
     * @return Package
     */
    public function createPackage(array $data): Package
    {
        return Package::query()->create($data);
    }

    /**
     * @param Package $package
     * @param array $data
     * @return Package
     */
    public function updatePackage(Package $package, array $data): Package
    {
        $package->update($data);
        return $package;
    }

    /**
     * @param Package $package
     * @return void
     */
    public function deletePackage(Package $package): void
    {
        $package->delete();
    }
}
