<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * 登録
     * @return void
     */
    public function register()
    {
    }

    /**
     * ブートストラップ
     * @return void
     */
    public function boot()
    {
        Paginator::useBootstrap();
    }
}
