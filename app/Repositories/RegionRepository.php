<?php

namespace App\Repositories;

use App\Models\Region;

class RegionRepository
{

    public function getRegionsWithRelations($filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $query = Region::query()->with([
            'translations' => function($query) {
                $query->select('region_id', 'title')->where('locale', 'en'); // Specify the translation columns
            },
            'city.translations' => function($query) {
                $query->select('city_id', 'title')->where('locale', 'en'); // Specify translation columns for City
            },
            'city' => function($query) {
                $query->select('id'); // Specify columns for City
            }
        ]);

        // Apply filters if any are provided
        if (!empty($filters['title'])) {
            $query->whereHas('translations', function($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['title'] . '%');
            });
        }

        if (!empty($filters['city_id'])) {
            $query->where('city_id', $filters['city_id']);
        }

        return $query->paginate(10);
    }
    public function create(array $data): Region
    {
        return Region::query()->create($data);
    }

    public function update(Region $region, array $data): Region
    {
        $region->update($data);
        return $region;
    }

    public function findById(string $id): ?Region
    {
        return Region::with('translations')->find($id);
    }

    public function delete(Region $region): void
    {
        $region->delete();
    }

    public function saveTranslations(Region $region, array $translations): void
    {
        foreach ($translations as $key => $value) {
            $region->translations()->updateOrCreate(
                ['locale' => $key],
                ['title' => $value]
            );
        }
    }
}
