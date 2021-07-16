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
use Adminetic\Website\Http\Controllers\CategoryController;
use Adminetic\Website\Http\Controllers\FacilityController;


Route::resource('category', CategoryController::class);
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

/* SINGLE ROUTES */
Route::get('delete_gallery_image', [GalleryController::class, 'delete_gallery_image'])->name('delete_gallery_image');
/* REORDER ROUTES */
Route::get('reorder-categories', [CategoryController::class, 'reorder_categories'])->name('reorder_categories');
Route::get('reorder-services', [ServiceController::class, 'reorder_services'])->name('reorder_services');
Route::get('reorder-facilities', [FacilityController::class, 'reorder_facilities'])->name('reorder_facilities');
Route::get('reorder-teams', [TeamController::class, 'reorder_teams'])->name('reorder_teams');
Route::get('reorder-faqs', [TeamController::class, 'reorder_faqs'])->name('reorder_faqs');
Route::get('reorder-reorder_pages', [PageController::class, 'reorder_pages'])->name('reorder_pages');
