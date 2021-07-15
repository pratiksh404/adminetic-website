<?php

namespace Adminetic\Website\Provider;

use App\Http\Livewire\Admin\Category\QuickCategory;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;

class WebsiteServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        Website::class => WebsitePolicy::class,
    ];

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        // Publish Ressource
        if ($this->app->runningInConsole()) {
            $this->publishResource();
        }
        // Register Resources
        $this->registerResource();
        // Register Policies
        $this->registerPolicies();
        // Register View Components
        $this->registerLivewireComponents();
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /* Repository Interface Binding */
        $this->repos();
        /* Register WebsiteEventServiceProvider */
        $this->app->register(WebsiteEventServiceProvider::class);
    }

    /**
     * Publish Package Resource.
     *
     *@return void
     */
    protected function publishResource()
    {
        // Publish Config File
        $this->publishes([
            __DIR__ . '/../../config/website.php' => config_path('website.php'),
        ], 'website-config');
        // Publish View Files
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/adminetic/plugin/website'),
        ], 'website-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'website-migrations');
    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'website'); // Loading Views Files
        $this->registerRoutes();
    }

    /**
     * Register Routes.
     *
     * @return void
     */
    protected function registerRoutes()
    {
        Route::group($this->routeConfiguration(), function () {
            $this->loadRoutesFrom(__DIR__ . '/../../routes/web.php');
        });
    }

    /**
     * Register Route Configuration.
     *
     * @return void
     */
    protected function routeConfiguration()
    {
        return [
            'prefix' => config('website.prefix', 'admin'),
            'middleware' => config('website.middleware', ['web', 'auth']),
        ];
    }

    /**
     * Register Components.
     *
     *@return void
     */
    protected function registerLivewireComponents()
    {
        Livewire::component('admin.category.quick-category', QuickCategory::class);
    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        //
    }

    /**
     * Register Policies.
     *
     *@return void
     */
    protected function registerPolicies()
    {
        foreach ($this->policies as $key => $value) {
            Gate::policy($key, $value);
        }
    }
}
