<?php

namespace Cody\LaravelDevelopTools;

use Illuminate\Support\ServiceProvider;

class LaravelDevelopToolsProvider extends ServiceProvider
{
    public function boot()
    {
        $this->publishes([
            __DIR__.'/config/laravel-develop-tools.php' => config_path('laravel-develop-tools.php'), // 发布配置文件到 laravel 的config 下
        ]);
    }

    public function register()
    {
        $this->app->singleton('speed-curd', function () {
            return new SpeedCurd();
        });
        $this->app->singleton('http-response', function () {
            return HttpResponse::class;
        });

        $this->app->singleton('fast-math', function () {
            return new FastMath();
        });
    }
}
