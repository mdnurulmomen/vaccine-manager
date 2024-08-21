<?php

namespace App\Providers;

use App\Http\Interfaces\InterestRepositoryInterface;
use App\Http\Repositories\InterestRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InterestRepositoryInterface::class, InterestRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
