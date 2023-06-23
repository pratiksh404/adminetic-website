<?php

namespace Spatie\MediaLibraryPro;

use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Blade;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\ServiceProvider;
use Livewire\Livewire;
use Spatie\MediaLibraryPro\Commands\DeleteTemporaryUploadsCommand;
use Spatie\MediaLibraryPro\Http\Components\MediaLibraryAttachmentComponent;
use Spatie\MediaLibraryPro\Http\Components\MediaLibraryCollectionComponent;
use Spatie\MediaLibraryPro\Http\Controllers\MediaLibraryPostS3Controller;
use Spatie\MediaLibraryPro\Http\Controllers\MediaLibraryUploadController;
use Spatie\MediaLibraryPro\Http\Livewire\LivewireMediaLibraryComponent;
use Spatie\MediaLibraryPro\Http\Livewire\LivewireUploaderComponent;
use Spatie\MediaLibraryPro\Models\TemporaryUpload;
use Spatie\MediaLibraryPro\Support\TemporaryUploadPathGenerator;

class MediaLibraryProServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->loadViewsFrom(__DIR__ . '/../resources/views', 'media-library');
        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang/', 'media-library');
        $this->loadJsonTranslationsFrom(__DIR__ . '/../resources/lang/');

        $this
            ->registerPublishables()
            ->registerBladeComponents()
            ->registerLivewireComponents()
            ->registerRouteMacros()
            ->registerTemporaryUploaderPathGenerator();
    }

    public function register()
    {
        parent::register();

        $this->commands([
            DeleteTemporaryUploadsCommand::class,
        ]);
    }

    protected function registerPublishables(): self
    {
        if (! class_exists('CreateTemporaryUploadsTable')) {
            $this->publishes([
                __DIR__ . '/../database/migrations/create_temporary_uploads_table.stub' => database_path('migrations/' . date('Y_m_d_His', time()) . '_create_temporary_uploads_table.php'),
            ], 'media-library-pro-migrations');
        }

        $this->publishes([
            __DIR__ . '/../resources/views' => base_path('resources/views/vendor/media-library'),
        ], 'media-library-pro-views');

        $this->publishes([
            __DIR__ . '/../resources/lang' => "{$this->app['path.lang']}/vendor/media-library",
        ], 'media-library-pro-lang');

        return $this;
    }

    public function registerBladeComponents(): self
    {
        Blade::component('media-library-attachment', MediaLibraryAttachmentComponent::class);
        Blade::component('media-library-collection', MediaLibraryCollectionComponent::class);
        Blade::component('media-library::components.media-library-icon', 'media-library-icon');
        Blade::component('media-library::components.media-library-button', 'media-library-button');

        return $this;
    }

    public function registerLivewireComponents(): self
    {
        if (! class_exists(Livewire::class)) {
            return $this;
        }

        Livewire::component('media-library', LivewireMediaLibraryComponent::class);
        Livewire::component('media-library-uploader', LivewireUploaderComponent::class);

        return $this;
    }

    public function registerRouteMacros(): self
    {
        RateLimiter::for('medialibrary-pro-uploads', function (Request $request) {
            return [
                Limit::perMinute(10)->by($request->ip()),
            ];
        });

        Route::macro('mediaLibrary', function (string $baseUrl = 'media-library-pro') {
            Route::prefix($baseUrl)->group(function () {
                if (config('media-library.enable_vapor_uploads')) {
                    Route::post("post-s3", '\\' . MediaLibraryPostS3Controller::class)
                        ->name('media-library-post-s3')
                        ->middleware(['throttle:medialibrary-pro-uploads']);

                    return;
                }

                Route::post("uploads", '\\' . MediaLibraryUploadController::class)
                    ->name('media-library-uploads')
                    ->middleware(['throttle:medialibrary-pro-uploads']);
            });
        });

        return $this;
    }

    public function registerTemporaryUploaderPathGenerator(): self
    {
        $configuredValues = config('media-library.custom_path_generators', []);

        if (! array_key_exists(TemporaryUpload::class, $configuredValues)) {
            $configuredValues[TemporaryUpload::class] = TemporaryUploadPathGenerator::class;
        }

        config()->set('media-library.custom_path_generators', $configuredValues);

        return $this;
    }
}
