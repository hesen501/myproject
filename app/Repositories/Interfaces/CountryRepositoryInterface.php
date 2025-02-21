<?php

namespace App\Repositories\Interfaces;

use App\Models\Country;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CountryRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllCountries(array $filters = []): LengthAwarePaginator;

    /**
     * @param string $id
     * @return Country|null
     */
    public function findCountryById(string $id): ?Country;

    /**
     * @param array $data
     * @return Country
     */
    public function createCountry(array $data): Country;

    /**
     * @param Country $country
     * @param array $data
     * @return Country
     */
    public function updateCountry(Country $country, array $data): Country;

    /**
     * @param Country $country
     * @return void
     */
    public function deleteCountry(Country $country): void;
}
