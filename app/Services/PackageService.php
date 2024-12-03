<?php

namespace App\Services;

use App\Http\Controllers\Admin\PackageController;
use App\Models\Package;
use App\Models\Tariff;
use App\Models\User;
use App\Models\Warehouse;
use App\Repositories\PackageRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class PackageService
{
    private PackageRepository $packageRepository;

    public function __construct(PackageRepository $packageRepository)
    {
        $this->packageRepository = $packageRepository;
    }

    public function createPackage(array $data): Package
    {
        $data['cwb_number'] = $this->generateCwbNumber();
        $data['delivery_cost'] = $this->calculateDeliveryCost($data) ?? 0;
        $data['delivery_cost_azn'] = round($data['delivery_cost'] * 1.7, 2);
        return $this->packageRepository->createPackage($data);
    }

    public function updatePackage(string $id, array $data): Package
    {
        $package = $this->packageRepository->findPackageById($id);
        if (!$package) {
            throw new ModelNotFoundException('Package not found');
        }

        return $this->packageRepository->updatePackage($package, $data);
    }

    public function deletePackage(string $id): void
    {
        $package = $this->packageRepository->findPackageById($id);
        if (!$package) {
            throw new ModelNotFoundException('Package not found');
        }

        $this->packageRepository->deletePackage($package);
    }

    public function findPackageById(string $id): ?Package
    {
        return $this->packageRepository->findPackageById($id);
    }

    public function getAllPackages(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->packageRepository->getAllPackages($filters);
    }

    private function generateCwbNumber(): string
    {
        $cwb_number = 'MBX'.rand(10000,99999);
        $checkPackage = Package::query()->where('cwb_number', $cwb_number)->exists();

        if ($checkPackage)
            $cwb_number = $this->generateCwbNumber();

        return $cwb_number;
    }

    private function calculateDeliveryCost($data): float
    {
        $warehouse = Warehouse::query()
            ->where('id', $data['warehouse_id'])
            ->first();

        $tariff = Tariff::query()
            ->where('country_id', $warehouse->country_id)
            ->where('min_weight','<=', $data['weight'])
            ->where('max_weight','>=', $data['weight'])
            ->first();

        return round($tariff->fee * $data['weight'],2);
    }

}
