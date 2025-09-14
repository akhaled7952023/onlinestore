<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;
use App\Models\Admin;
use App\Policies\AdminsManagementPolicy;

class AuthServiceProvider extends ServiceProvider
{
    protected $policies = [
        Admin::class => AdminsManagementPolicy::class,
    ];

    public function boot(): void
    {
        $this->registerPolicies();
    }
}
