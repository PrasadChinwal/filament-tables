<?php

use Illuminate\Support\Facades\Route;

Route::get('/', \App\Livewire\Users::class)->name('home');

Route::get('/user-test', \App\Livewire\Users::class)->name('user.index');
