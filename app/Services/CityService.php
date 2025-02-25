<?php

namespace App\Services;

use App\Models\City;
use App\Repositories\CityRepository;

class CityService
{
    private CityRepository $cityRepository;

    public function __construct(CityRepository $cityRepository)
    {
        $this->cityRepository = $cityRepository;
    }

    public function createCity(array $data): City
    {
        $city = $this->cityRepository->createCity($data);
        $this->cityRepository->saveTranslations($city, $data['translations'] ?? []);

        return $city;
    }

    /**
     * @throws \Exception
     */
    public function updateCity(string $id, array $data): City
    {
        $city = $this->cityRepository->findCityById($id);
        if (!$city) {
            throw new \Exception('City not found');
        }

        $this->cityRepository->updateCity($city, $data);
        $this->cityRepository->saveTranslations($city, $data['translations'] ?? []);

        return $this->cityRepository->findCityById($id);
    }

    public function deleteCity(string $id): void
    {
        $city = $this->cityRepository->findCityById($id);
        if (!$city) {
            throw new \Exception('City not found');
        }

        $this->cityRepository->deleteCity($city);
    }

    public function findCityById(string $id): ?City
    {
        $city = $this->cityRepository->findCityById($id);
        // Format the translations
        if ($city){
            foreach ($city->translations as $key => $item) {
                $city->translations[$item->locale] = $item->title;
                unset($city->translations[$key]);
            }
        }

        return $city;
    }

    public function getAllCities(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        $cities =  $this->cityRepository->getAllCities($filters);
        // Format the response
        foreach ($cities as $city) {
            $city->title = $city->translations->firstWhere('locale', 'en')->title ?? null;
            unset($city->translations);
        }

        return $cities;
    }
}
