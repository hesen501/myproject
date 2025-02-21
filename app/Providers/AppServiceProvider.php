<?php

namespace App\Providers;

use App\Repositories\BranchRepository;
use App\Repositories\CityRepository;
use App\Repositories\CountryRepository;
use App\Repositories\Interfaces\BranchRepositoryInterface;
use App\Repositories\Interfaces\CityRepositoryInterface;
use App\Repositories\Interfaces\CountryRepositoryInterface;
use App\Repositories\Interfaces\PackageRepositoryInterface;
use App\Repositories\Interfaces\ParcelRepositoryInterface;
use App\Repositories\Interfaces\RegionRepositoryInterface;
use App\Repositories\Interfaces\TariffRepositoryInterface;
use App\Repositories\Interfaces\WarehouseRepositoryInterface;
use App\Repositories\PackageRepository;
use App\Repositories\ParcelRepository;
use App\Repositories\RegionRepository;
use App\Repositories\TariffRepository;
use App\Repositories\WarehouseRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(BranchRepositoryInterface::class,BranchRepository::class);
        $this->app->bind(CityRepositoryInterface::class,CityRepository::class);
        $this->app->bind(CountryRepositoryInterface::class,CountryRepository::class);
        $this->app->bind(PackageRepositoryInterface::class,PackageRepository::class);
        $this->app->bind(ParcelRepositoryInterface::class,ParcelRepository::class);
        $this->app->bind(RegionRepositoryInterface::class,RegionRepository::class);
        $this->app->bind(TariffRepositoryInterface::class,TariffRepository::class);
        $this->app->bind(WarehouseRepositoryInterface::class,WarehouseRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
