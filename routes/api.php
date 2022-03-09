
<?php

use Adminetic\Website\Http\Controllers\API\Client\ClientClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\CounterClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\EventClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\FacilityClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\FaqClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\FeatureClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\GalleryClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\ImageClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\PackageClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\PageClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\PopupClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\PostClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\ProjectClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\ServiceClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\TeamClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\TestimonialClientAPIController;
use Adminetic\Website\Http\Controllers\API\Client\VideoClientAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\ClientRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\CounterRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\EventRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\FacilityRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\FaqRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\FeatureRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\GalleryRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\ImageRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\PackageRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\PageRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\PopupRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\PostRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\ProjectRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\ServiceRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\TeamRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\TestimonialRestAPIController;
use Adminetic\Website\Http\Controllers\API\Restful\VideoRestAPIController;
use Illuminate\Support\Facades\Route;

if (config('website.website_client_api_end_points', true)) {
    Route::prefix(config('website.client_api_prefix', 'client'))->group(function () {
        Route::get('client', [ClientClientAPIController::class, 'index']);
        Route::get('client/{client}', [ClientClientAPIController::class, 'show']);
        Route::get('counter', [CounterClientAPIController::class, 'index']);
        Route::get('counter/{counter}', [CounterClientAPIController::class, 'show']);
        Route::get('event', [EventClientAPIController::class, 'index']);
        Route::get('event/{event}', [EventClientAPIController::class, 'show']);
        Route::get('facility', [FacilityClientAPIController::class, 'index']);
        Route::get('facility/{facility}', [FacilityClientAPIController::class, 'show']);
        Route::get('faq', [FaqClientAPIController::class, 'index']);
        Route::get('faq/{faq}', [FaqClientAPIController::class, 'show']);
        Route::get('feature', [FeatureClientAPIController::class, 'index']);
        Route::get('feature/{feature}', [FeatureClientAPIController::class, 'show']);
        Route::get('gallery', [GalleryClientAPIController::class, 'index']);
        Route::get('gallery/{gallery}', [GalleryClientAPIController::class, 'show']);
        Route::get('image', [ImageClientAPIController::class, 'index']);
        Route::get('image/{image}', [ImageClientAPIController::class, 'show']);
        Route::get('package', [PackageClientAPIController::class, 'index']);
        Route::get('package/{package}', [PackageClientAPIController::class, 'show']);
        Route::get('page', [PageClientAPIController::class, 'index']);
        Route::get('page/{page}', [PageClientAPIController::class, 'show']);
        Route::get('popup', [PopupClientAPIController::class, 'index']);
        Route::get('popup/{popup}', [PopupClientAPIController::class, 'show']);
        Route::get('post', [PostClientAPIController::class, 'index']);
        Route::get('post/{post}', [PostClientAPIController::class, 'show']);
        Route::get('project', [ProjectClientAPIController::class, 'index']);
        Route::get('project/{project}', [ProjectClientAPIController::class, 'show']);
        Route::get('service', [ServiceClientAPIController::class, 'index']);
        Route::get('service/{service}', [ServiceClientAPIController::class, 'show']);
        Route::get('team', [TeamClientAPIController::class, 'index']);
        Route::get('team/{team}', [TeamClientAPIController::class, 'show']);
        Route::get('testimonial', [TestimonialClientAPIController::class, 'index']);
        Route::get('testimonial/{testimonial}', [TestimonialClientAPIController::class, 'show']);
        Route::get('video', [VideoClientAPIController::class, 'index']);
        Route::get('video/{video}', [VideoClientAPIController::class, 'show']);
    });
}

if (config('website.website_restful_api_end_points', true)) {
    Route::group(['prefix' => config('website.rest_api_prefix', 'rest'), 'middleware' => ['auth:api']], function () {
        Route::resource('client', ClientRestAPIController::class);
        Route::resource('counter', CounterRestAPIController::class);
        Route::resource('event', EventRestAPIController::class);
        Route::resource('facility', FacilityRestAPIController::class);
        Route::resource('faq', FaqRestAPIController::class);
        Route::resource('feature', FeatureRestAPIController::class);
        Route::resource('gallery', GalleryRestAPIController::class);
        Route::resource('image', ImageRestAPIController::class);
        Route::resource('package', PackageRestAPIController::class);
        Route::resource('page', PageRestAPIController::class);
        Route::resource('popup', PopupRestAPIController::class);
        Route::resource('post', PostRestAPIController::class);
        Route::resource('project', ProjectRestAPIController::class);
        Route::resource('service', ServiceRestAPIController::class);
        Route::resource('team', TeamRestAPIController::class);
        Route::resource('testimonial', TestimonialRestAPIController::class);
        Route::resource('video', VideoRestAPIController::class);
    });
}
