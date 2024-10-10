<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Http\Repositories\UserRepository;
use App\Http\Interfaces\UserRepositoryInterface;
use App\Http\Repositories\UserVaccineRepository;
use App\Http\Repositories\VaccineCenterRepository;
use App\Http\Interfaces\UserVaccineRepositoryInterface;
use App\Http\Interfaces\VaccineCenterRepositoryInterface;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        $this->app->bind(VaccineCenterRepositoryInterface::class, VaccineCenterRepository::class);
        $this->app->bind(UserVaccineRepositoryInterface::class, UserVaccineRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
