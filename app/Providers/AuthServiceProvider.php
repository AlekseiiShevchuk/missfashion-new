<?php

namespace App\Providers;

use Illuminate\Support\Facades\Gate;
use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;

class AuthServiceProvider extends ServiceProvider
{
    /**
     * The policy mappings for the application.
     *
     * @var array
     */
    protected $policies = [
        'App\Model' => 'App\Policies\ModelPolicy',
    ];

    /**
     * Register any authentication / authorization services.
     *
     * @return void
     */
    public function boot()
    {
        $this->registerPolicies();

        $user = \Auth::user();

        
        // Auth gates for: User management
        Gate::define('user_management_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_management_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_management_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_management_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_management_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Roles
        Gate::define('role_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('role_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Users
        Gate::define('user_access', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_create', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_edit', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('user_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Donor
        Gate::define('donor_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('donor_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('donor_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('donor_view', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('donor_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Categories
        Gate::define('category_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('category_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('category_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Product attributes
        Gate::define('product_attribute_access', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Images
        Gate::define('image_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('image_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('image_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('image_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('image_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Colors
        Gate::define('color_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('color_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('color_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('color_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('color_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Sizes
        Gate::define('size_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('size_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('size_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('size_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('size_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

        // Auth gates for: Products
        Gate::define('product_access', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_create', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_edit', function ($user) {
            return in_array($user->role_id, [1]);
        });
        Gate::define('product_view', function ($user) {
            return in_array($user->role_id, [1, 2]);
        });
        Gate::define('product_delete', function ($user) {
            return in_array($user->role_id, [1]);
        });

    }
}
