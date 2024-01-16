<?php

use App\Http\Controllers\ImpersonateController;
use App\Http\Controllers\RoleController;
use Illuminate\Support\Facades\Route;
use Livewire\Livewire;
use UisIts\Oidc\Http\Controllers\AuthController;

Livewire::setScriptRoute(function($handle) {
    return Route::get('/'. env('VITE_APP_NAME') . '/livewire/livewire.js', $handle);
});
Livewire::setUpdateRoute(function($handle) {
    return Route::get('/' . env('VITE_APP_NAME') . '/livewire/update', $handle);
});

Route::name('login')->get('login', [AuthController::class, 'login']);

Route::name('callback')->get('/auth/callback', [AuthController::class, 'callback']);

Route::name('logout')->get('/logout', [AuthController::class, 'logout']);

//Route::get('/getCourses', 'CourseApiController@index');
//Route::get('/getTerms', 'TermApiController@index');

Route::get('/', function(){
    return view('schedule.index');
})->name('home');

Route::get('/user-test', \App\Livewire\Users::class)->name('user.index');

Route::middleware('auth')->group(function() {
//    Route::get('/user', [UserController::class, '__invoke'])->name('user.index');
    Route::get('/role', [RoleController::class, '__invoke'])->name('role.index');
    Route::resource('/impersonate', ImpersonateController::class)
        ->only(['store', 'destroy']);
    Route::get('/Feedbacks', function() {
        return view('feedback.index');
    });
    Route::get('/help', function() {
        return view('help.index');
    });

});
