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

    /**
     * @param string $id
     * @return Country|null
     */
    public function findCountryById(string $id): ?Country
    {
        return Country::query()->find($id);
    }

    /**
     * @param array $data
     * @return Country
     */
    public function createCountry(array $data): Country
    {
        return Country::query()->create($data);
    }

    /**
     * @param Country $country
     * @param array $data
     * @return Country
     */
    public function updateCountry(Country $country, array $data): Country
    {
        $country->update($data);
        return $country;
    }

    /**
     * @param Country $country
     * @return void
     */
    public function deleteCountry(Country $country): void
    {
        $country->delete();
    }
}
