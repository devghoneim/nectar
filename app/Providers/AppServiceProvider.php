<?php

namespace App\Providers;

use App\Events\OtpRequested;
use App\Listeners\GenerateOtp;
use App\Repository\Elqount\UserRepository;
use App\Repository\Interface\UserRepositoryInterface;
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
        
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Event::Listen(OtpRequested::class,GenerateOtp::class);
    }
}
