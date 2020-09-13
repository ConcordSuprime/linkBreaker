<?php

namespace App\Providers;

use Illuminate\Support\Facades\Validator;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('valid_link', 'App\Validators\CustomLinkValidator@validLink', 'Целевая ссылка не действительна.');
        Validator::extend('unique_name_link', 'App\Validators\CustomLinkValidator@uniqueNameLink', 'Ссылка с таким названием уже существует.');
    }


    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}

