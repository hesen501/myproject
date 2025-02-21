<?php

namespace App\Services;

use App\Models\Region;
use App\Repositories\RegionRepository;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class RegionService
{
    private RegionRepository $regionRepository;

    public function __construct(RegionRepository $regionRepository)
    {
        $this->regionRepository = $regionRepository;
    }

    public function getRegions($filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $regions = $this->regionRepository->getRegionsWithRelations($filters);

        foreach ($regions as $region){
            // Handle city translations
            $cityTranslation = $region->city->translations->first();
            $region->city->title = $cityTranslation ? $cityTranslation->title : 'No translation found';
            unset($region->city->translations);

            // Handle region translations
            $regionTranslation = $region->translations->first();
            $region->title = $regionTranslation ? $regionTranslation->title : 'No translation found';
            unset($region->translations);
        }

        return $regions;
    }
    public function createRegion(array $data): Region
    {
        $region = $this->regionRepository->create($data);
        $this->regionRepository->saveTranslations($region, $data['translations'] ?? []);

        return $region;
    }

    public function updateRegion(Region $region, array $data): Region
    {
        $region = $this->regionRepository->update($region, $data);
        $this->regionRepository->saveTranslations($region, $data['translations'] ?? []);

        return $region;
    }

    public function deleteRegion(string $id): void
    {
        $region = $this->regionRepository->findById($id);

        if (!$region) {
            throw new ModelNotFoundException("Region not found");
        }

        $this->regionRepository->delete($region);
    }

    public function findRegionById(string $id): ?Region
    {
        $region = $this->regionRepository->findById($id);

        if ($region) {
            foreach ($region->translations as $key => $item) {
                $region->translations[$item->locale] = $item->title;
                unset($region->translations[$key]);
            }
        }

        return $region;
    }
}
