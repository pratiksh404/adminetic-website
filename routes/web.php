<?php

use Adminetic\Website\Http\Controllers\BlockController;
use Adminetic\Website\Http\Controllers\ClientController;
use Adminetic\Website\Http\Controllers\CounterController;
use Adminetic\Website\Http\Controllers\EventController;
use Adminetic\Website\Http\Controllers\FacilityController;
use Adminetic\Website\Http\Controllers\FaqController;
use Adminetic\Website\Http\Controllers\FeatureController;
use Adminetic\Website\Http\Controllers\GalleryController;
use Adminetic\Website\Http\Controllers\ImageController;
use Adminetic\Website\Http\Controllers\PackageController;
use Adminetic\Website\Http\Controllers\PageController;
use Adminetic\Website\Http\Controllers\PostController;
use Adminetic\Website\Http\Controllers\ProjectController;
use Adminetic\Website\Http\Controllers\ServiceController;
use Adminetic\Website\Http\Controllers\TeamController;
use Adminetic\Website\Http\Controllers\TemplateController;
use Adminetic\Website\Http\Controllers\TestimonialController;
use Adminetic\Website\Http\Controllers\VideoController;
use Adminetic\Website\Http\Controllers\WebsiteAnalyticsController;
use Illuminate\Support\Facades\Route;

Route::resource('service', ServiceController::class);
Route::resource('facility', FacilityController::class);
Route::resource('counter', CounterController::class);
Route::resource('team', TeamController::class);
Route::resource('faq', FaqController::class);
Route::resource('package', PackageController::class);
Route::resource('project', ProjectController::class);
Route::resource('client', ClientController::class);
Route::resource('gallery', GalleryController::class);
Route::resource('image', ImageController::class);
Route::resource('page', PageController::class);
Route::resource('event', EventController::class);
Route::resource('video', VideoController::class);
Route::resource('post', PostController::class);
Route::resource('template', TemplateController::class);
Route::resource('block', BlockController::class);
Route::resource('testimonial', TestimonialController::class);
Route::resource('feature', FeatureController::class);

/* AJAX ROUTE */
Route::get('get_template', [TemplateController::class, 'get_template'])->name('get_template');

/* Charts Routes */
Route::get('get-monthly-poster-view', [PosterController::class, 'get_monthly_poster_view'])->name('get_monthly_poster_view');
Route::get('get-monthly-post-view', [PostController::class, 'get_monthly_post_view'])->name('get_monthly_post_view');
Route::get('get-monthly-total-post-view', [PostController::class, 'get_monthly_post_total_view'])->name('get_monthly_post_total_view');

Route::get('view-by-country-column-chart', [WebsiteAnalyticsController::class, 'viewByCountryColumnChart'])->name('viewByCountryColumnChart');
Route::get('view-by-days-column-chart', [WebsiteAnalyticsController::class, 'viewByDaysColumnChart'])->name('viewByDaysColumnChart');
Route::get('top-referrers-column-chart', [WebsiteAnalyticsController::class, 'topReferrersColumnChart'])->name('topReferrersColumnChart');
Route::get('new-vs-returning-vistor-pie-chart', [WebsiteAnalyticsController::class, 'newVsReturningVistorPieChart'])->name('newVsReturningVistorPieChart');
Route::get('top-browsers-pie-chart', [WebsiteAnalyticsController::class, 'topBrowsersPieChart'])->name('topBrowsersPieChart');
Route::get('most-visited-pages-bar-chart', [WebsiteAnalyticsController::class, 'mostVisitedPagesBarChart'])->name('mostVisitedPagesBarChart');

Route::get('get-monthly-post-total-view', [WebsiteAnalyticsController::class, 'getMonthlyPostTotalView'])->name('getMonthlyPostTotalView');
