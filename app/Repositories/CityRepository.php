<?php

namespace App\Repositories;

use App\Models\City;
use App\Repositories\Interfaces\CityRepositoryInterface;
use Faker\Provider\Base;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CityRepository
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllCities(array $filters = []): LengthAwarePaginator
    {
        $query = City::query()->with([
            'translations' => function ($query) {
                $query->select('city_id', 'locale', 'title');
            }
        ]);

        if (!empty($filters['title']) && strlen($filters['title']) > 0) {
            $query->whereHas('translations', function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['title'] . '%');
            });
        }

        if (isset($filters['delivery_status'])) {
            $query->where('delivery_status', $filters['delivery_status']);
        }

        return $query->paginate(10);
    }

    /**
     * @param string $id
     * @return City|null
     */
    public function findCityById(string $id): ?City
    {
        return City::with(['translations' => function($query) {
            $query->select('city_id', 'locale', 'title'); // Specify the translation columns
        }])->findOrFail($id);
    }

    public function createCity(array $data): City
    {
        return City::query()->create($data);
    }

    /**
     * @param City $city
     * @param array $data
     * @return City
     */
    public function updateCity(City $city, array $data): City
    {
        $city->update($data);
        return $city;
    }

    /**
     * @param City $city
     * @return void
     */
    public function deleteCity(City $city): void
    {
        $city->delete();
    }

    public function saveTranslations(City $city, array $translations): void
    {
        foreach ($translations as $locale => $title) {
            if (!$title)
                continue;
            $city->translations()->updateOrCreate(
                ['locale' => $locale],
                ['title' => $title]
            );
        }
    }
}
