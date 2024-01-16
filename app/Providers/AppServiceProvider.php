<?php

namespace App\Providers;

use \Illuminate\Support\Collection;
use Laravel\Dusk\DuskServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\ServiceProvider;
use Illuminate\Http\Resources\Json\JsonResource;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        JsonResource::withoutWrapping();
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //Register Laravel Collection Macros
//        Collection::macro('toAssoc', function () {
//            return $this->reduce(function ($assoc, $keyValuePair) {
//                list($key, $value) = $keyValuePair;
//                $assoc[$key] = $value;
//                return $assoc;
//            }, new static);
//        });
//
//        Collection::macro('mapToAssoc', function ($callback) {
//            return $this->map($callback)->toAssoc();
//        });

    }
}

