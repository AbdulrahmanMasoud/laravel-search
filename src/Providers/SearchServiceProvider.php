<?php

namespace TheAMasoud\LaravelSearch\Providers;

use Illuminate\Support\ServiceProvider;

class SearchServiceProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../../config/search.php' => config_path('search.php'),
        ], 'config');
    }
}
