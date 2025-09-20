<?php

namespace App\Providers;

use App\Services\Dashboard\Admins\AdminService;
use App\Services\Dashboard\Admins\IAdminService;
use App\Services\Dashboard\Brand\BrandService;
use App\Services\Dashboard\Brand\IBrandService;
use App\Services\Dashboard\Categories\CategoryService;
use App\Services\Dashboard\Categories\ICategoryService;
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
        $this->app->bind(ICategoryService::class, CategoryService::class);
        $this->app->bind(IBrandService::class, BrandService::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
