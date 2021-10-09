<?php

use Illuminate\Support\Facades\Route;
use Adminetic\Website\Http\Controllers\FaqController;
use Adminetic\Website\Http\Controllers\PageController;
use Adminetic\Website\Http\Controllers\TeamController;
use Adminetic\Website\Http\Controllers\ImageController;
use Adminetic\Website\Http\Controllers\VideoController;
use Adminetic\Website\Http\Controllers\ClientController;
use Adminetic\Website\Http\Controllers\CounterController;
use Adminetic\Website\Http\Controllers\GalleryController;
use Adminetic\Website\Http\Controllers\PackageController;
use Adminetic\Website\Http\Controllers\ProjectController;
use Adminetic\Website\Http\Controllers\ServiceController;
use Adminetic\Website\Http\Controllers\FacilityController;
use Adminetic\Website\Http\Controllers\PostController;
use Adminetic\Website\Http\Controllers\TemplateController;

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
Route::resource('video', VideoController::class);
Route::resource('post', PostController::class);
Route::resource('template', TemplateController::class);

/* AJAX ROUTE */
Route::get('get_template', [TemplateController::class, 'get_template'])->name('get_template');

/* Charts Routes */
Route::get('get-monthly-poster-view', [PosterController::class, 'get_monthly_poster_view'])->name('get_monthly_poster_view');
Route::get('get-monthly-post-view', [PostController::class, 'get_monthly_post_view'])->name('get_monthly_post_view');
Route::get('get-monthly-total-post-view', [PostController::class, 'get_monthly_post_total_view'])->name('get_monthly_post_total_view');
