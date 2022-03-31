<?php

namespace App\Providers;

use App\Models\MenuItem;
use Gloudemans\Shoppingcart\Facades\Cart;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        $menuItems = MenuItem::where('enabled', 1)->orderBy('sort_order')->get();

        View::composer('*', function ($view) use ($menuItems) {
            $view->with(compact('menuItems'));
        });
    }
}
