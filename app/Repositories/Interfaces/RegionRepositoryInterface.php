<?php

namespace App\Repositories\Interfaces;

use App\Models\Region;
use Illuminate\Pagination\LengthAwarePaginator;

interface RegionRepositoryInterface
{

    /**
     *
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getRegionsWithRelations(array $filters = []): LengthAwarePaginator;

    /**
     * @param array $data
     * @return Region
     */
    public function create(array $data): Region;

    /**
     * @param Region $region
     * @param array $data
     * @return Region
     */
    public function update(Region $region, array $data): Region;

    /**
     * @param string $id
     * @return Region|null
     */
    public function findById(string $id): ?Region;

    /**
     * @param Region $region
     * @return void
     */
    public function delete(Region $region): void;

    /**
     * @param Region $region
     * @param array $translations
     * @return void
     */
    public function saveTranslations(Region $region, array $translations): void;
}
