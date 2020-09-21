<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

use App\Menus;

use Illuminate\Support\Facades\View;
use Illuminate\Pagination\Paginator;

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
        //
        $menus = Menus::whereNull('parent_id')->orderBy('oder', 'ASC')->get();

        View::share('menus', $menus);
    }
}
