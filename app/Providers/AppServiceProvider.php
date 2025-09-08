<?php

namespace App\Providers;

use App\Events\OtpRequested;
use App\Listeners\GenerateOtp;
use App\Repository\Elqount\BrandRepository;
use App\Repository\Elqount\LocationRepository;
use App\Repository\Elqount\UserRepository;
use App\Repository\Elqount\ZoneRepository;
use App\Repository\Interface\BrandRepositoryInterface;
use App\Repository\Interface\LocationRepositoryInterface;
use App\Repository\Interface\UserRepositoryInterface;
use App\Repository\Interface\ZoneRepoistoryInterface;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(UserRepositoryInterface::class,UserRepository::class);
        $this->app->bind(ZoneRepoistoryInterface::class,ZoneRepository::class);
        $this->app->bind(LocationRepositoryInterface::class,LocationRepository::class);
        $this->app->bind(BrandRepositoryInterface::class,BrandRepository::class);
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::Listen(OtpRequested::class,GenerateOtp::class);
    }
}
