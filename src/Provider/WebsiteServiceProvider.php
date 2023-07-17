<?php

namespace Adminetic\Website\Provider;

use Adminetic\Website\Console\Commands\AdmineticWebsiteInstallCommand;
use Adminetic\Website\Console\Commands\AdmineticWebsiteMigrateCommand;
use Adminetic\Website\Console\Commands\AdmineticWebsitePermissionCommand;
use Adminetic\Website\Console\Commands\AdmineticWebsiteRollbackCommand;
use Adminetic\Website\Console\Commands\SitemapGenerateCommand;
use Adminetic\Website\Http\Livewire\Admin\Attribute\AttributeTable;
use Adminetic\Website\Http\Livewire\Admin\Career\ApplicationTable;
use Adminetic\Website\Http\Livewire\Admin\Career\CareerTable;
use Adminetic\Website\Http\Livewire\Admin\Career\Selection;
use Adminetic\Website\Http\Livewire\Admin\Career\Summary;
use Adminetic\Website\Http\Livewire\Admin\Category\CategoryTable;
use Adminetic\Website\Http\Livewire\Admin\Category\QuickCategory;
use Adminetic\Website\Http\Livewire\Admin\Charts\Event\EventPassChart;
use Adminetic\Website\Http\Livewire\Admin\Charts\Event\EventPaymentChart;
use Adminetic\Website\Http\Livewire\Admin\Client\ClientTable;
use Adminetic\Website\Http\Livewire\Admin\Counter\CounterTable;
use Adminetic\Website\Http\Livewire\Admin\Dashboard\NewsHeadline;
use Adminetic\Website\Http\Livewire\Admin\Dashboard\WebsiteDashboard;
use Adminetic\Website\Http\Livewire\Admin\Download\DownloadTable;
use Adminetic\Website\Http\Livewire\Admin\Facility\FacilityTable;
use Adminetic\Website\Http\Livewire\Admin\Faq\FaqTable;
use Adminetic\Website\Http\Livewire\Admin\Feature\FeatureTable;
use Adminetic\Website\Http\Livewire\Admin\Slider\SliderTable;
use Adminetic\Website\Http\Livewire\Admin\About\AboutTable;
use Adminetic\Website\Http\Livewire\Admin\Gallery\GalleryTable;
use Adminetic\Website\Http\Livewire\Admin\Gallery\GalleryVideo;
use Adminetic\Website\Http\Livewire\Admin\Notice\NoticeTable;
use Adminetic\Website\Http\Livewire\Admin\Package\PackageFeature;
use Adminetic\Website\Http\Livewire\Admin\Package\PackageTable;
use Adminetic\Website\Http\Livewire\Admin\Page\PageTable;
use Adminetic\Website\Http\Livewire\Admin\Payment\PaymentMaster;
use Adminetic\Website\Http\Livewire\Admin\Payment\PaymentPanel;
use Adminetic\Website\Http\Livewire\Admin\Payment\PaymentTable;
use Adminetic\Website\Http\Livewire\Admin\Popup\PopupTable;
use Adminetic\Website\Http\Livewire\Admin\Post\PostTable;
use Adminetic\Website\Http\Livewire\Admin\Process\ProcessTable;
use Adminetic\Website\Http\Livewire\Admin\Product\ProductTable;
use Adminetic\Website\Http\Livewire\Admin\Project\ProjectTable;
use Adminetic\Website\Http\Livewire\Admin\Service\ServiceTable;
use Adminetic\Website\Http\Livewire\Admin\Software\SoftwareModules;
use Adminetic\Website\Http\Livewire\Admin\Software\SoftwareTable;
use Adminetic\Website\Http\Livewire\Admin\System\UploadImage;
use Adminetic\Website\Http\Livewire\Admin\Team\TeamTable;
use Adminetic\Website\Http\Livewire\Admin\Testimonial\TestimonialTable;
use Adminetic\Website\Http\Livewire\Admin\History\HistoryTable;
use Adminetic\Website\Models\Admin\Application;
use Adminetic\Website\Models\Admin\Attribute;
use Adminetic\Website\Models\Admin\Career;
use Adminetic\Website\Models\Admin\Category;
use Adminetic\Website\Models\Admin\Client;
use Adminetic\Website\Models\Admin\Counter;
use Adminetic\Website\Models\Admin\Download;
use Adminetic\Website\Models\Admin\Facility;
use Adminetic\Website\Models\Admin\Faq;
use Adminetic\Website\Models\Admin\Feature;
use Adminetic\Website\Models\Admin\Gallery;
use Adminetic\Website\Models\Admin\Notice;
use Adminetic\Website\Models\Admin\Package;
use Adminetic\Website\Models\Admin\Page;
use Adminetic\Website\Models\Admin\Payment;
use Adminetic\Website\Models\Admin\Popup;
use Adminetic\Website\Models\Admin\Post;
use Adminetic\Website\Models\Admin\Process;
use Adminetic\Website\Models\Admin\Product;
use Adminetic\Website\Models\Admin\Project;
use Adminetic\Website\Models\Admin\Service;
use Adminetic\Website\Models\Admin\Software;
use Adminetic\Website\Models\Admin\Team;
use Adminetic\Website\Models\Admin\Testimonial;
use Adminetic\Website\Policies\ApplicationPolicy;
use Adminetic\Website\Policies\AttributePolicy;
use Adminetic\Website\Policies\CareerPolicy;
use Adminetic\Website\Policies\CategoryPolicy;
use Adminetic\Website\Policies\ClientPolicy;
use Adminetic\Website\Policies\CounterPolicy;
use Adminetic\Website\Policies\DownloadPolicy;
use Adminetic\Website\Policies\FacilityPolicy;
use Adminetic\Website\Policies\FaqPolicy;
use Adminetic\Website\Policies\FeaturePolicy;
use Adminetic\Website\Policies\GalleryPolicy;
use Adminetic\Website\Policies\NoticePolicy;
use Adminetic\Website\Policies\PackagePolicy;
use Adminetic\Website\Policies\PagePolicy;
use Adminetic\Website\Policies\PaymentPolicy;
use Adminetic\Website\Policies\PopupPolicy;
use Adminetic\Website\Policies\PostPolicy;
use Adminetic\Website\Policies\ProcessPolicy;
use Adminetic\Website\Policies\ProductPolicy;
use Adminetic\Website\Policies\ProjectPolicy;
use Adminetic\Website\Policies\ServicePolicy;
use Adminetic\Website\Policies\SoftwarePolicy;
use Adminetic\Website\Policies\TeamPolicy;
use Adminetic\Website\Policies\TestimonialPolicy;
use Adminetic\Website\Models\Admin\Slider;
use Adminetic\Website\Policies\SliderPolicy;
use Adminetic\Website\Models\Admin\About;
use Adminetic\Website\Policies\AboutPolicy;
use Adminetic\Website\Models\Admin\History;
use Adminetic\Website\Policies\HistoryPolicy;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;

class WebsiteServiceProvider extends ServiceProvider
{
    // Register Policies
    protected $policies = [
        Application::class => ApplicationPolicy::class,
        Attribute::class => AttributePolicy::class,
        Career::class => CareerPolicy::class,
        Category::class => CategoryPolicy::class,
        Client::class => ClientPolicy::class,
        Counter::class => CounterPolicy::class,
        Download::class => DownloadPolicy::class,
        Facility::class => FacilityPolicy::class,
        Faq::class => FaqPolicy::class,
        Feature::class => FeaturePolicy::class,
        Gallery::class => GalleryPolicy::class,
        Notice::class => NoticePolicy::class,
        Package::class => PackagePolicy::class,
        Page::class => PagePolicy::class,
        Payment::class => PaymentPolicy::class,
        Popup::class => PopupPolicy::class,
        Post::class => PostPolicy::class,
        Process::class => ProcessPolicy::class,
        Product::class => ProductPolicy::class,
        Project::class => ProjectPolicy::class,
        Service::class => ServicePolicy::class,
        Software::class => SoftwarePolicy::class,
        Team::class => TeamPolicy::class,
        Testimonial::class => TestimonialPolicy::class,
        Slider::class => SliderPolicy::class,
        About::class => AboutPolicy::class,
        History::class => HistoryPolicy::class,


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
            __DIR__.'/../../database/migrations' => database_path('migrations/website'),
        ], 'website-migrations');
        $this->publishes([
            __DIR__.'/../../payload/assets' => public_path('plugins/website'),
        ], 'website-assets');
        $this->publishes([
            __DIR__.'/../../payload/modules' => app_path('Modules'),
        ], 'website-modules');
    }

    /**
     * Register Package Resource.
     *
     *@return void
     */
    protected function registerResource()
    {
        if (! config('website.publish_migrations', true)) {
            $this->loadMigrationsFrom(__DIR__.'/../../database/migrations'); // Loading Migration Files
        }
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
            AdmineticWebsiteInstallCommand::class,
            AdmineticWebsitePermissionCommand::class,
            AdmineticWebsiteMigrateCommand::class,
            AdmineticWebsiteRollbackCommand::class,
            SitemapGenerateCommand::class,
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

        if (config('website.website_api_end_points', true)) {
            Route::group($this->apiRouteConfiguration(), function () {
                $this->loadRoutesFrom(__DIR__.'/../../routes/api.php');
            });
        }
    }

    /**
     * Register Route Configuration.
     *
     * @return array
     */
    protected function routeConfiguration()
    {
        return [
            'prefix' => config('adminetic.prefix', 'admin'),
            'middleware' => config('adminetic.middleware', ['web', 'auth']),
        ];
    }

    /**
     * Register API Route Configuration.
     *
     *@return array
     */
    protected function apiRouteConfiguration()
    {
        return [
            'prefix' => config('website.api_prefix', 'api'),
            'middleware' => config('website.api_middleware', ['api']),
        ];
    }

    /**
     * Register Components.
     *
     *@return void
     */
    protected function registerLivewireComponents()
    {
        Livewire::component('admin.attribute.attribute-table', AttributeTable::class);
        Livewire::component('admin.career.application-table', ApplicationTable::class);
        Livewire::component('admin.career.career-table', CareerTable::class);
        Livewire::component('admin.career.selection', Selection::class);
        Livewire::component('admin.career.summary', Summary::class);
        Livewire::component('admin.category.category-table', CategoryTable::class);
        Livewire::component('admin.category.quick-category', QuickCategory::class);
        Livewire::component('admin.charts.event.event-pass-chart', EventPassChart::class);
        Livewire::component('admin.charts.event.event-payment-chart', EventPaymentChart::class);
        Livewire::component('admin.client.client-table', ClientTable::class);
        Livewire::component('admin.counter.counter-table', CounterTable::class);
        Livewire::component('admin.dashboard.news-headline', NewsHeadline::class);
        Livewire::component('admin.dashboard.website-dashboard', WebsiteDashboard::class);
        Livewire::component('admin.download.download-table', DownloadTable::class);
        Livewire::component('admin.facility.facility-table', FacilityTable::class);
        Livewire::component('admin.faq.faq-table', FaqTable::class);
        Livewire::component('admin.feature.feature-table', FeatureTable::class);
        Livewire::component('admin.gallery.gallery-table', GalleryTable::class);
        Livewire::component('admin.gallery.gallery-video', GalleryVideo::class);
        Livewire::component('admin.notice.notice-table', NoticeTable::class);
        Livewire::component('admin.package.package-table', PackageTable::class);
        Livewire::component('admin.package.package-feature', PackageFeature::class);
        Livewire::component('admin.page.page-table', PageTable::class);
        Livewire::component('admin.payment.payment-master', PaymentMaster::class);
        Livewire::component('admin.payment.payment-panel', PaymentPanel::class);
        Livewire::component('admin.payment.payment-table', PaymentTable::class);
        Livewire::component('admin.popup.faq-table', PopupTable::class);
        Livewire::component('admin.post.post-table', PostTable::class);
        Livewire::component('admin.process.process-table', ProcessTable::class);
        Livewire::component('admin.product.product-table', ProductTable::class);
        Livewire::component('admin.project.project-table', ProjectTable::class);
        Livewire::component('admin.service.service-table', ServiceTable::class);
        Livewire::component('admin.software.software-table', SoftwareTable::class);
        Livewire::component('admin.software.software-modules', SoftwareModules::class);
        Livewire::component('admin.system.upload-image', UploadImage::class);
        Livewire::component('admin.team.team-table', TeamTable::class);
        Livewire::component('admin.testimonial.testimonial-table', TestimonialTable::class);
        Livewire::component('admin.slider.slider-table', SliderTable::class);
        Livewire::component('admin.about.about-table', AboutTable::class);
        Livewire::component('admin.history.history-table', HistoryTable::class);



    }

    /**
     * Repository Binding.
     *
     * @return void
     */
    protected function repos()
    {
        $this->app->bind(\Adminetic\Website\Contracts\CategoryRepositoryInterface::class, \Adminetic\Website\Repositories\CategoryRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\ServiceRepositoryInterface::class, \Adminetic\Website\Repositories\ServiceRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\FacilityRepositoryInterface::class, \Adminetic\Website\Repositories\FacilityRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\FeatureRepositoryInterface::class, \Adminetic\Website\Repositories\FeatureRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\FaqRepositoryInterface::class, \Adminetic\Website\Repositories\FaqRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\CounterRepositoryInterface::class, \Adminetic\Website\Repositories\CounterRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\GalleryRepositoryInterface::class, \Adminetic\Website\Repositories\GalleryRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\ClientRepositoryInterface::class, \Adminetic\Website\Repositories\ClientRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\NoticeRepositoryInterface::class, \Adminetic\Website\Repositories\NoticeRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\PopupRepositoryInterface::class, \Adminetic\Website\Repositories\PopupRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\DownloadRepositoryInterface::class, \Adminetic\Website\Repositories\DownloadRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\PageRepositoryInterface::class, \Adminetic\Website\Repositories\PageRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\TestimonialRepositoryInterface::class, \Adminetic\Website\Repositories\TestimonialRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\TeamRepositoryInterface::class, \Adminetic\Website\Repositories\TeamRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\PackageRepositoryInterface::class, \Adminetic\Website\Repositories\PackageRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\ProjectRepositoryInterface::class, \Adminetic\Website\Repositories\ProjectRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\EventRepositoryInterface::class, \Adminetic\Website\Repositories\EventRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\TicketRepositoryInterface::class, \Adminetic\Website\Repositories\TicketRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\GuestRepositoryInterface::class, \Adminetic\Website\Repositories\GuestRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\CouponRepositoryInterface::class, \Adminetic\Website\Repositories\CouponRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\PaymentRepositoryInterface::class, \Adminetic\Website\Repositories\PaymentRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\PostRepositoryInterface::class, \Adminetic\Website\Repositories\PostRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\CareerRepositoryInterface::class, \Adminetic\Website\Repositories\CareerRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\AttributeRepositoryInterface::class, \Adminetic\Website\Repositories\AttributeRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\ProductRepositoryInterface::class, \Adminetic\Website\Repositories\ProductRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\ProcessRepositoryInterface::class, \Adminetic\Website\Repositories\ProcessRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\SoftwareRepositoryInterface::class, \Adminetic\Website\Repositories\SoftwareRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\SliderRepositoryInterface::class, \Adminetic\Website\Repositories\SliderRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\AboutRepositoryInterface::class, \Adminetic\Website\Repositories\AboutRepository::class);
        $this->app->bind(\Adminetic\Website\Contracts\HistoryRepositoryInterface::class, \Adminetic\Website\Repositories\HistoryRepository::class);
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
