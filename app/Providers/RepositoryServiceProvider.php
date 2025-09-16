<?php

namespace App\Providers;

use App\Repositories\Base\BaseRepository;
use App\Repositories\Base\IBaseRepositoryInterface;
use App\Repositories\Dashboard\Admins\AdminRepository;
use App\Repositories\Dashboard\Admins\IAdminRepository;
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
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
