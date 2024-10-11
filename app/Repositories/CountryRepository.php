<?php

namespace App\Repositories;

use App\Models\Country;

class CountryRepository
{
    public function getAllCountries($filters = [])
    {
        $query = Country::query();

        if (!empty($filters['title'])) {
            $query->where('title', 'like', '%' . $filters['title'] . '%');
        }

        if (isset($filters['delivery_status'])) {
            $query->where('delivery_status', $filters['delivery_status']);
        }

        return $query->paginate(10);
    }

    public function findCountryById(string $id): ?Country
    {
        return Country::query()->find($id);
    }

    public function createCountry(array $data): Country
    {
        return Country::query()->create($data);
    }

    public function updateCountry(Country $country, array $data): Country
    {
        $country->update($data);
        return $country;
    }

    public function deleteCountry(Country $country): void
    {
        $country->delete();
    }
}
