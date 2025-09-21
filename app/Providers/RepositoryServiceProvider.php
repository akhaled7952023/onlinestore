<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\IBaseRepositoryInterface;
use App\Repositories\Dashboard\Admins\AdminRepository;
use App\Repositories\Dashboard\Admins\IAdminRepository;
use App\Repositories\Dashboard\Brand\BrandRepository;
use App\Repositories\Dashboard\Brand\IBrandRepository;
use App\Repositories\Dashboard\Categories\CategoryRepository;
use App\Repositories\Dashboard\Categories\ICategoryRepository;
use App\Repositories\Dashboard\Coupon\CouponRepository;
use App\Repositories\Dashboard\Coupon\ICouponRepository;
use App\Repositories\Dashboard\World\IWorldRepository;
use App\Repositories\Dashboard\World\WorldRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind(IBaseRepositoryInterface::class,BaseRepository::class);
        $this->app->bind(IAdminRepository::class, AdminRepository::class);
        $this->app->bind(IWorldRepository::class, WorldRepository::class);
        $this->app->bind(ICategoryRepository::class, CategoryRepository::class);
        $this->app->bind(IBrandRepository::class, BrandRepository::class);
        $this->app->bind(ICouponRepository::class, CouponRepository::class);
    }
    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
