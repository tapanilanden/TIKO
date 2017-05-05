<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use Validator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('has_semicolon', function($attribute, $value, $parameters, $validator) {
            return ends_with($value, ';');
        });

        Validator::extend('paired_parenthesis', function($attribute, $value, $parameters, $validator) {
            return substr_count($value, '(') === substr_count($value, ')');
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
