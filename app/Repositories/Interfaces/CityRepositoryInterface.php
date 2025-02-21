<?php

namespace App\Repositories\Interfaces;

use App\Models\City;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

interface CityRepositoryInterface
{
    /**
     * @param array $filters
     * @return LengthAwarePaginator
     */
    public function getAllCities(array $filters = []): LengthAwarePaginator;

    /**
     * @param string $id
     * @return City|null
     */
    public function findCityById(string $id): ?City;

    public function createCity(array $data): City;

    /**
     * @param City $city
     * @param array $data
     * @return City
     */
    public function updateCity(City $city, array $data): City;

    /**
     * @param City $city
     * @return void
     */
    public function deleteCity(City $city): void;
}
