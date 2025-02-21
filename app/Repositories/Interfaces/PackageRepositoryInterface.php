<?php

namespace App\Repositories\Interfaces;

use App\Models\Package;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface PackageRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllPackages(array $filters = []): LengthAwarePaginator;

    /**
     * @param string $id
     * @return Package|null
     */
    public function findPackageById(string $id): ?Package;

    /**
     * @param array $data
     * @return Package
     */
    public function createPackage(array $data): Package;

    /**
     * @param Package $package
     * @param array $data
     * @return Package
     */
    public function updatePackage(Package $package, array $data): Package;

    /**
     * @param Package $package
     * @return void
     */
    public function deletePackage(Package $package): void;
}
