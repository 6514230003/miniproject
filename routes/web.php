<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Jobs\JobsController;
use Illuminate\Support\Facades\Auth;



Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');


Route::get('/jobs/single/{id}', [App\Http\Controllers\Jobs\JobsController::class, 'single'])->name('single.job');
Route::post('/jobs/save', [App\Http\Controllers\Jobs\JobsController::class, 'saveJob'])->name('save.job');
Route::post('/jobs/apply', [App\Http\Controllers\Jobs\JobsController::class, 'jobApply'])->name('apply.job');

Route::get('/categories/single/{name}', [App\Http\Controllers\Categories\CategoriesController::class, 'singleCategory'])->name('categories.single');


Route::get('/users/profile', [App\Http\Controllers\Users\UsersController::class, 'profile'])->name('profile');
Route::get('/users/applications', [App\Http\Controllers\Users\UsersController::class, 'applications'])->name('applications');

Route::get('/users/savedjobs', [App\Http\Controllers\Users\UsersController::class, 'savedjobs'])->name('saved.jobs');
Route::get('/users/edit-details', [App\Http\Controllers\Users\UsersController::class, 'editDetails'])->name('edit.details');
Route::post('/users/edit-details', [App\Http\Controllers\Users\UsersController::class, 'updateDetails'])->name('update.details');

Route::get('/admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'viewLogin'])->name('view.login');
Route::post('/admin/login', [App\Http\Controllers\Admins\AdminsController::class, 'checkLogin'])->name('check.login');
Route::get('admin', [App\Http\Controllers\Admins\AdminsController::class, 'index'])->name('admins.dashboard');


