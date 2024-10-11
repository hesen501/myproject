<?php

namespace App\Repositories;

use App\Models\City;

class CityRepository
{
    public function getAllCities(array $filters = [])
    {
        $query = City::query()->with(['translations' => function($query) {
            $query->select('city_id', 'locale', 'title'); // Specify the translation columns
        }]);

        if (strlen($filters['title']) > 0) {
            $query->whereHas('translations', function ($q) use ($filters) {
                $q->where('title', 'like', '%' . $filters['title'] . '%');
            });
        }

        if (isset($filters['delivery_status'])) {
            $query->where('delivery_status', $filters['delivery_status']);
        }

        return $query->paginate(10);
    }

    public function findCityById(string $id): ?City
    {
        return City::with(['translations' => function($query) {
            $query->select('city_id', 'locale', 'title'); // Specify the translation columns
        }])->find($id);
    }

    public function createCity(array $data): City
    {
        return City::query()->create($data);
    }

    public function updateCity(City $city, array $data): City
    {
        $city->update($data);
        return $city;
    }

    public function deleteCity(City $city): void
    {
        $city->delete();
    }
}
