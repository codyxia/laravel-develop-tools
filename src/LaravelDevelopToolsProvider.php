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
        /**
         * 增删改查
         */
        $this->app->singleton('speed-curd', function () {
            return new SpeedCurd();
        });
        /**
         * 格式化JSON返回数据
         */
        $this->app->singleton('http-response', function () {
            return HttpResponse::class;
        });
        /**
         * 数学计算
         */
        $this->app->singleton('fast-math', function () {
            return new FastMath();
        });
        /**
         * 参数验证
         */
        $this->app->singleton('verify-request', function () {
            return new VerifyRequest();
        });
        /**
         * 数组工具
         */
        $this->app->singleton('super-arr', function () {
            return new SuperArr();
        });
    }
}
