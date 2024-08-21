<?php

namespace App\Providers;

use App\Http\Interfaces\InterestRepositoryInterface;
use App\Http\Interfaces\LocationRepositoryInterface;
use App\Http\Interfaces\PoliticalPartyRepositoryInterface;
use App\Http\Interfaces\SkillRepositoryInterface;
use App\Http\Interfaces\UserInterestRepositoryInterface;
use App\Http\Interfaces\UserLocationRepositoryInterface;
use App\Http\Interfaces\UserPoliticalPartyRepositoryInterface;
use App\Http\Interfaces\UserSkillRepositoryInterface;
use App\Http\Interfaces\UserTypeRepositoryInterface;
use App\Http\Repositories\InterestRepository;
use App\Http\Repositories\LocationRepository;
use App\Http\Repositories\PoliticalPartyRepository;
use App\Http\Repositories\SkillRepository;
use App\Http\Repositories\UserInterestRepository;
use App\Http\Repositories\UserLocationRepository;
use App\Http\Repositories\UserPoliticalPartyRepository;
use App\Http\Repositories\UserSkillRepository;
use App\Http\Repositories\UserTypeRepository;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(InterestRepositoryInterface::class, InterestRepository::class);
        $this->app->bind(LocationRepositoryInterface::class, LocationRepository::class);
        $this->app->bind(PoliticalPartyRepositoryInterface::class, PoliticalPartyRepository::class);
        $this->app->bind(SkillRepositoryInterface::class, SkillRepository::class);
        $this->app->bind(UserInterestRepositoryInterface::class, UserInterestRepository::class);
        $this->app->bind(UserLocationRepositoryInterface::class, UserLocationRepository::class);
        $this->app->bind(UserPoliticalPartyRepositoryInterface::class, UserPoliticalPartyRepository::class);
        $this->app->bind(UserSkillRepositoryInterface::class, UserSkillRepository::class);
        $this->app->bind(UserTypeRepositoryInterface::class, UserTypeRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
