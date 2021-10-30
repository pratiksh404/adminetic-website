<?php

namespace Adminetic\Website\Provider;

use Adminetic\Website\Console\Commands\AdmineticWebsiteInstallCommand;
use Adminetic\Website\Console\Commands\AdmineticWebsitePermissionCommand;
use Adminetic\Website\Contracts\BlockRepositoryInterface;
use Adminetic\Website\Contracts\ClientRepositoryInterface;
use Adminetic\Website\Contracts\CounterRepositoryInterface;
use Adminetic\Website\Contracts\EventRepositoryInterface;
use Adminetic\Website\Contracts\FacilityRepositoryInterface;
use Adminetic\Website\Contracts\FaqRepositoryInterface;
use Adminetic\Website\Contracts\FeatureRepositoryInterface;
use Adminetic\Website\Contracts\GalleryRepositoryInterface;
use Adminetic\Website\Contracts\ImageRepositoryInterface;
use Adminetic\Website\Contracts\PackageRepositoryInterface;
use Adminetic\Website\Contracts\PageRepositoryInterface;
use Adminetic\Website\Contracts\PostRepositoryInterface;
use Adminetic\Website\Contracts\ProjectRepositoryInterface;
use Adminetic\Website\Contracts\ServiceRepositoryInterface;
use Adminetic\Website\Contracts\TeamRepositoryInterface;
use Adminetic\Website\Contracts\TemplateRepositoryInterface;
use Adminetic\Website\Contracts\TestimonialRepositoryInterface;
use Adminetic\Website\Contracts\VideoRepositoryInterface;
use Adminetic\Website\Http\Livewire\Admin\Analytics\DurationSpendOnSite;
use Adminetic\Website\Http\Livewire\Admin\Analytics\TopExitPages;
use Adminetic\Website\Http\Livewire\Admin\Analytics\TopLandingPages;
use Adminetic\Website\Http\Livewire\Admin\Block\BlockVc;
use Adminetic\Website\Http\Livewire\Admin\Block\ReorderBlock;
use Adminetic\Website\Http\Livewire\Admin\Facility\ReorderFacility;
use Adminetic\Website\Http\Livewire\Admin\Faq\ReorderFaq;
use Adminetic\Website\Http\Livewire\Admin\Feature\ReorderFeature;
use Adminetic\Website\Http\Livewire\Admin\Gallery\GalleryImages;
use Adminetic\Website\Http\Livewire\Admin\Package\ReorderPackage;
use Adminetic\Website\Http\Livewire\Admin\Page\ReorderPage;
use Adminetic\Website\Http\Livewire\Admin\Post\PostFeatured;
use Adminetic\Website\Http\Livewire\Admin\Post\PostPriority;
use Adminetic\Website\Http\Livewire\Admin\Post\PostsTable;
use Adminetic\Website\Http\Livewire\Admin\Post\PostStatus;
use Adminetic\Website\Http\Livewire\Admin\Service\ReorderService;
use Adminetic\Website\Http\Livewire\Admin\Team\ReorderTeam;
use Adminetic\Website\Http\Livewire\Admin\Testimonial\ReorderTestimonial;
use Adminetic\Website\Http\Livewire\Admin\Video\ReorderVideo;
use Adminetic\Website\Models\Admin\Block;
use Adminetic\Website\Models\Admin\Client;
use Adminetic\Website\Models\Admin\Counter;
use Adminetic\Website\Models\Admin\Event;
use Adminetic\Website\Models\Admin\Facility;
use Adminetic\Website\Models\Admin\Faq;
use Adminetic\Website\Models\Admin\Feature;
use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Models\Admin\Image;
use Adminetic\Website\Models\Admin\Package;
use Adminetic\Website\Models\Admin\Page;
use Adminetic\Website\Models\Admin\Post;
use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Models\Admin\Service;
use Adminetic\Website\Models\Admin\Team;
use Adminetic\Website\Models\Admin\Template;
use Adminetic\Website\Models\Admin\Testimonial;
use Adminetic\Website\Models\Admin\Video;
use Adminetic\Website\Policies\BlockPolicy;
use Adminetic\Website\Policies\ClientPolicy;
use Adminetic\Website\Policies\CounterPolicy;
use Adminetic\Website\Policies\EventPolicy;
use Adminetic\Website\Policies\FacilityPolicy;
use Adminetic\Website\Policies\FaqPolicy;
use Adminetic\Website\Policies\FeaturePolicy;
use Adminetic\Website\Policies\GalleryPolicy;
use Adminetic\Website\Policies\ImagePolicy;
use Adminetic\Website\Policies\PackagePolicy;
use Adminetic\Website\Policies\PagePolicy;
use Adminetic\Website\Policies\PostPolicy;
use Adminetic\Website\Policies\ProjectPolicy;
use Adminetic\Website\Policies\ServicePolicy;
use Adminetic\Website\Policies\TeamPolicy;
use Adminetic\Website\Policies\TemplatePolicy;
use Adminetic\Website\Policies\TestimonialPolicy;
use Adminetic\Website\Policies\VideoPolicy;
use Adminetic\Website\Repositories\BlockRepository;
use Adminetic\Website\Repositories\ClientRepository;
use Adminetic\Website\Repositories\CounterRepository;
use Adminetic\Website\Repositories\EventRepository;
use Adminetic\Website\Repositories\FacilityRepository;
use Adminetic\Website\Repositories\FaqRepository;
use Adminetic\Website\Repositories\FeatureRepository;
use Adminetic\Website\Repositories\GalleryRepository;
use Adminetic\Website\Repositories\ImageRepository;
use Adminetic\Website\Repositories\PackageRepository;
use Adminetic\Website\Repositories\PageRepository;
use Adminetic\Website\Repositories\PostRepository;
use Adminetic\Website\Repositories\ProjectRepository;
use Adminetic\Website\Repositories\ServiceRepository;
use Adminetic\Website\Repositories\TeamRepository;
use Adminetic\Website\Repositories\TemplateRepository;
use Adminetic\Website\Repositories\TestimonialRepository;
use Adminetic\Website\Repositories\VideoRepository;
use Adminetic\Website\View\Components\WebsiteAnalyticsDashboard;
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
        Event::class => EventPolicy::class,
        Post::class => PostPolicy::class,
        Template::class => TemplatePolicy::class,
        Block::class => BlockPolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        Feature::class => FeaturePolicy::class
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
        $this->registerComponents();
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
     * Register Package Command.
     *
     *@return void
     */
    protected function registerCommands()
    {
        $this->commands([
            AdmineticWebsiteInstallCommand::class,
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
        Livewire::component('admin.feature.reorder-feature', ReorderFeature::class);
        Livewire::component('admin.testimonial.reorder-testimonial', ReorderTestimonial::class);
        Livewire::component('admin.video.reorder-video', ReorderVideo::class);
        Livewire::component('admin.package.reorder-package', ReorderPackage::class);
        Livewire::component('admin.block.reorder-block', ReorderBlock::class);
        Livewire::component('admin.block.block-vc', BlockVc::class);
        Livewire::component('admin.facility.reorder-facility', ReorderFacility::class);
        Livewire::component('admin.faq.reorder-faq', ReorderFaq::class);
        Livewire::component('admin.page.reorder-page', ReorderPage::class);
        Livewire::component('admin.service.reorder-service', ReorderService::class);
        Livewire::component('admin.team.reorder-team', ReorderTeam::class);
        Livewire::component('admin.gallery.gallery-images', GalleryImages::class);
        Livewire::component('admin.post.post-featured', PostFeatured::class);
        Livewire::component('admin.post.post-priority', PostPriority::class);
        Livewire::component('admin.post.posts-table', PostsTable::class);
        Livewire::component('admin.post.post-status', PostStatus::class);
        Livewire::component('admin.analytics.duration-spend-on-site', DurationSpendOnSite::class);
        Livewire::component('admin.analytics.top-exit-pages', TopExitPages::class);
        Livewire::component('admin.analytics.top-landing-pages', TopLandingPages::class);
    }

    /**
     * Register View Components.
     *
     *@return void
     */
    protected function registerComponents()
    {
        $this->loadViewComponentsAs('adminetic', [
            WebsiteAnalyticsDashboard::class,
        ]);
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
        $this->app->bind(EventRepositoryInterface::class, EventRepository::class);
        $this->app->bind(PostRepositoryInterface::class, PostRepository::class);
        $this->app->bind(TemplateRepositoryInterface::class, TemplateRepository::class);
        $this->app->bind(BlockRepositoryInterface::class, BlockRepository::class);
        $this->app->bind(TestimonialRepositoryInterface::class, TestimonialRepository::class);
        $this->app->bind(FeatureRepositoryInterface::class, FeatureRepository::class);
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
