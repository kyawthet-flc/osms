<?php

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model\Client\Shop' => 'App\Policies\ShopPolicy',
        'App\Model\Client\Product' => 'App\Policies\ProductPolicy',
        'App\Model\Client\Customer' => 'App\Policies\CustomerPolicy',
        'App\Model\Client\Supplier' => 'App\Policies\SupplierPolicy'
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        //
    }
}
