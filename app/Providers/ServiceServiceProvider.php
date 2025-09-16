<?php

namespace App\Providers;

use App\Services\Dashboard\Admins\AdminService;
use App\Services\Dashboard\Admins\IAdminService;
use App\Services\Dashboard\World\IWorldService;
use App\Services\Dashboard\World\WorldService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminService::class, AdminService::class);
        $this->app->bind(IWorldService::class, WorldService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
