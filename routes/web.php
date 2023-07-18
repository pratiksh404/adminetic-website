<?php

use Illuminate\Support\Facades\Route;

Route::resource('category', \Adminetic\Website\Http\Controllers\Admin\CategoryController::class);
Route::resource('service', \Adminetic\Website\Http\Controllers\Admin\ServiceController::class);
Route::resource('facility', \Adminetic\Website\Http\Controllers\Admin\FacilityController::class);
Route::resource('feature', \Adminetic\Website\Http\Controllers\Admin\FeatureController::class);
Route::resource('faq', \Adminetic\Website\Http\Controllers\Admin\FaqController::class);
Route::resource('counter', \Adminetic\Website\Http\Controllers\Admin\CounterController::class);
Route::resource('gallery', \Adminetic\Website\Http\Controllers\Admin\GalleryController::class);
Route::resource('client', \Adminetic\Website\Http\Controllers\Admin\ClientController::class);
Route::resource('notice', \Adminetic\Website\Http\Controllers\Admin\NoticeController::class);
Route::resource('popup', \Adminetic\Website\Http\Controllers\Admin\PopupController::class);
Route::resource('download', \Adminetic\Website\Http\Controllers\Admin\DownloadController::class);
Route::resource('page', \Adminetic\Website\Http\Controllers\Admin\PageController::class);
Route::resource('testimonial', \Adminetic\Website\Http\Controllers\Admin\TestimonialController::class);
Route::resource('team', \Adminetic\Website\Http\Controllers\Admin\TeamController::class);
Route::resource('package', \Adminetic\Website\Http\Controllers\Admin\PackageController::class);
Route::resource('project', \Adminetic\Website\Http\Controllers\Admin\ProjectController::class);
Route::resource('payment', \Adminetic\Website\Http\Controllers\Admin\PaymentController::class);
Route::resource('post', \Adminetic\Website\Http\Controllers\Admin\PostController::class);
Route::resource('career', \Adminetic\Website\Http\Controllers\Admin\CareerController::class);
Route::resource('attribute', \Adminetic\Website\Http\Controllers\Admin\AttributeController::class);
Route::resource('product', \Adminetic\Website\Http\Controllers\Admin\ProductController::class);
Route::resource('process', \Adminetic\Website\Http\Controllers\Admin\ProcessController::class);
Route::resource('software', \Adminetic\Website\Http\Controllers\Admin\SoftwareController::class);

// CAREER
Route::get('career-application/{career}', [\Adminetic\Website\Http\Controllers\Admin\CareerController::class, 'applications'])->name('career.applications');
Route::get('application/{application}', [\Adminetic\Website\Http\Controllers\Admin\CareerController::class, 'application'])->name('application.show');

// Message
Route::get('message', [\Adminetic\Website\Http\Controllers\Admin\MessageController::class, 'index'])->name('visitorMessage');
Route::get('inquiry', [\Adminetic\Website\Http\Controllers\Admin\InquiryController::class, 'index'])->name('visitorInquiry');

Route::resource('slider', \Adminetic\Website\Http\Controllers\Admin\SliderController::class);
Route::resource('about', \Adminetic\Website\Http\Controllers\Admin\AboutController::class);
Route::resource('history', \Adminetic\Website\Http\Controllers\Admin\HistoryController::class);
