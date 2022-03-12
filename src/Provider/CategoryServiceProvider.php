<?php

namespace Adminetic\Website\Provider;

use Livewire\Livewire;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Adminetic\Website\Models\Admin\Category;
use Adminetic\Website\Policies\CategoryPolicy;
use Adminetic\Website\Repository\CategoryRepository;
use Adminetic\Website\Contracts\CategoryRepositoryInterface;
use Adminetic\Website\Console\AdmineticCategoryInstallCommand;
use Adminetic\Website\Http\Livewire\Admin\Category\QuickCategory;
use Adminetic\Website\Http\Livewire\Admin\Category\ReorderParentCategory;
use Adminetic\Website\Http\Livewire\Admin\Category\ReorderChildrenCategory;


class CategoryServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        Category::class => CategoryPolicy::class,
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
        $this->registerCommands();
        /* Repository Interface Binding */
        $this->repos();
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
            __DIR__ . '/../../config/category.php' => config_path('category.php'),
        ], 'category-config');
        // Publish View Files
        $this->publishes([
            __DIR__ . '/../../resources/views' => resource_path('views/vendor/adminetic/plugin/category'),
        ], 'category-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__ . '/../../database/migrations' => database_path('migrations'),
        ], 'category-migrations');
    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__ . '/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__ . '/../../resources/views', 'category'); // Loading Views Files
        $this->registerRoutes();
    }

    /**
     * Register Package Command.
     *
     *@return void
     */
    protected function registerCommands()
    {
        $this->commands([
            AdmineticCategoryInstallCommand::class,
        ]);
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
            'prefix' => config('adminetic.prefix', 'admin'),
            'middleware' => config('adminetic.middleware', ['web', 'auth']),
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
        Livewire::component('admin.category.reorder-children-category', ReorderChildrenCategory::class);
        Livewire::component('admin.category.reorder-parent-category', ReorderParentCategory::class);
    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        $this->app->bind(CategoryRepositoryInterface::class, CategoryRepository::class);
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
