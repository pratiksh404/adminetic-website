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
