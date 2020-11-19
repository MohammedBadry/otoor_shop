<?php

namespace App\Providers;

use App\Support\Cache\CacheFactory;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewComposerServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer('layouts.otoraty.master', function ($view) {
            $categories = CacheFactory::make('categories')
                ->get(country()->id.'.categories', function () {
                    return country()
                        ->categories()
                        ->parentsOnly()
                        ->where('display_in_navbar', true)
                        ->get();
                });
            $view->with(compact('categories'));
        });
    }
}
