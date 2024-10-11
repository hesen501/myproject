<?php

namespace App\Services;

use App\Models\Country;
use App\Repositories\CountryRepository;

class CountryService
{
    private CountryRepository $countryRepository;

    public function __construct(CountryRepository $countryRepository)
    {
        $this->countryRepository = $countryRepository;
    }

    public function createCountry(array $data): Country
    {
        return $this->countryRepository->createCountry($data);
    }

    public function updateCountry(string $id, array $data): Country
    {
        $country = $this->countryRepository->findCountryById($id);
        if (!$country) {
            throw new \Exception('Country not found');
        }

        return $this->countryRepository->updateCountry($country, $data);
    }

    public function deleteCountry(string $id): void
    {
        $country = $this->countryRepository->findCountryById($id);
        if (!$country) {
            throw new \Exception('Country not found');
        }

        $this->countryRepository->deleteCountry($country);
    }

    public function findCountryById(string $id): ?Country
    {
        return $this->countryRepository->findCountryById($id);
    }

    public function getAllCountries(array $filters = []): \Illuminate\Pagination\LengthAwarePaginator
    {
        return $this->countryRepository->getAllCountries($filters);
    }
}
