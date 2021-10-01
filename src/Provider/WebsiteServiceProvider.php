<?php

namespace Adminetic\Website\Provider;

use Adminetic\Website\Console\Commands\AdmineticWebsitePermissionCommand;
use Adminetic\Website\Contracts\ClientRepositoryInterface;
use Adminetic\Website\Contracts\CounterRepositoryInterface;
use Adminetic\Website\Contracts\FacilityRepositoryInterface;
use Adminetic\Website\Contracts\FaqRepositoryInterface;
use Adminetic\Website\Contracts\GalleryRepositoryInterface;
use Adminetic\Website\Contracts\ImageRepositoryInterface;
use Adminetic\Website\Contracts\PackageRepositoryInterface;
use Adminetic\Website\Contracts\PageRepositoryInterface;
use Adminetic\Website\Contracts\ProjectRepositoryInterface;
use Adminetic\Website\Contracts\ServiceRepositoryInterface;
use Adminetic\Website\Contracts\TeamRepositoryInterface;
use Adminetic\Website\Contracts\VideoRepositoryInterface;
use Adminetic\Website\Http\Livewire\Admin\Facility\ReorderFacility;
use Adminetic\Website\Http\Livewire\Admin\Faq\ReorderFaq;
use Adminetic\Website\Http\Livewire\Admin\Gallery\GalleryImages;
use Adminetic\Website\Http\Livewire\Admin\Page\ReorderPage;
use Adminetic\Website\Http\Livewire\Admin\Service\ReorderService;
use Adminetic\Website\Http\Livewire\Admin\Team\ReorderTeam;
use Adminetic\Website\Models\Admin\Client;
use Adminetic\Website\Models\Admin\Counter;
use Adminetic\Website\Models\Admin\Facility;
use Adminetic\Website\Models\Admin\Faq;
use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Models\Admin\Image;
use Adminetic\Website\Models\Admin\Package;
use Adminetic\Website\Models\Admin\Page;
use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Models\Admin\Service;
use Adminetic\Website\Models\Admin\Team;
use Adminetic\Website\Models\Admin\Video;
use Adminetic\Website\Policies\ClientPolicy;
use Adminetic\Website\Policies\CounterPolicy;
use Adminetic\Website\Policies\FacilityPolicy;
use Adminetic\Website\Policies\FaqPolicy;
use Adminetic\Website\Policies\GalleryPolicy;
use Adminetic\Website\Policies\ImagePolicy;
use Adminetic\Website\Policies\PackagePolicy;
use Adminetic\Website\Policies\PagePolicy;
use Adminetic\Website\Policies\ProjectPolicy;
use Adminetic\Website\Policies\ServicePolicy;
use Adminetic\Website\Policies\TeamPolicy;
use Adminetic\Website\Policies\VideoPolicy;
use Adminetic\Website\Repository\ClientRepository;
use Adminetic\Website\Repository\CounterRepository;
use Adminetic\Website\Repository\FacilityRepository;
use Adminetic\Website\Repository\FaqRepository;
use Adminetic\Website\Repository\GalleryRepository;
use Adminetic\Website\Repository\ImageRepository;
use Adminetic\Website\Repository\PackageRepository;
use Adminetic\Website\Repository\PageRepository;
use Adminetic\Website\Repository\ProjectRepository;
use Adminetic\Website\Repository\ServiceRepository;
use Adminetic\Website\Repository\TeamRepository;
use Adminetic\Website\Repository\VideoRepository;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class WebsiteServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        Client::class => ClientPolicy::class,
        Counter::class => CounterPolicy::class,
        Facility::class => FacilityPolicy::class,
        Faq::class => FaqPolicy::class,
        Gallery::class => GalleryPolicy::class,
        Image::class => ImagePolicy::class,
        Package::class => PackagePolicy::class,
        Page::class => PagePolicy::class,
        Project::class => ProjectPolicy::class,
        Service::class => ServicePolicy::class,
        Team::class => TeamPolicy::class,
        Video::class => VideoPolicy::class,
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
            __DIR__.'/../../config/website.php' => config_path('website.php'),
        ], 'website-config');
        // Publish View Files
        $this->publishes([
            __DIR__.'/../../resources/views' => resource_path('views/vendor/adminetic/plugin/website'),
        ], 'website-views');
        // Publish Migration Files
        $this->publishes([
            __DIR__.'/../../database/migrations' => database_path('migrations'),
        ], 'website-migrations');
    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        $this->loadMigrationsFrom(__DIR__.'/../../database/migrations'); // Loading Migration Files
        $this->loadViewsFrom(__DIR__.'/../../resources/views', 'website'); // Loading Views Files
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
            AdmineticWebsitePermissionCommand::class,
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
            $this->loadRoutesFrom(__DIR__.'/../../routes/web.php');
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
        Livewire::component('admin.facility.reorder-facility', ReorderFacility::class);
        Livewire::component('admin.faq.reorder-faq', ReorderFaq::class);
        Livewire::component('admin.page.reorder-page', ReorderPage::class);
        Livewire::component('admin.service.reorder-service', ReorderService::class);
        Livewire::component('admin.team.reorder-team', ReorderTeam::class);
        Livewire::component('admin.gallery.gallery-images', GalleryImages::class);
    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        $this->app->bind(ServiceRepositoryInterface::class, ServiceRepository::class);
        $this->app->bind(FacilityRepositoryInterface::class, FacilityRepository::class);
        $this->app->bind(CounterRepositoryInterface::class, CounterRepository::class);
        $this->app->bind(TeamRepositoryInterface::class, TeamRepository::class);
        $this->app->bind(FaqRepositoryInterface::class, FaqRepository::class);
        $this->app->bind(PackageRepositoryInterface::class, PackageRepository::class);
        $this->app->bind(ProjectRepositoryInterface::class, ProjectRepository::class);
        $this->app->bind(ClientRepositoryInterface::class, ClientRepository::class);
        $this->app->bind(GalleryRepositoryInterface::class, GalleryRepository::class);
        $this->app->bind(ImageRepositoryInterface::class, ImageRepository::class);
        $this->app->bind(PageRepositoryInterface::class, PageRepository::class);
        $this->app->bind(VideoRepositoryInterface::class, VideoRepository::class);
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
