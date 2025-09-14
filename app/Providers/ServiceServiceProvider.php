<?php

namespace App\Providers;

use App\Services\Dashboard\Admins\AdminService;
use App\Services\Dashboard\Admins\IAdminService;
use Illuminate\Support\ServiceProvider;

class ServiceServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IAdminService::class, AdminService::class);
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
