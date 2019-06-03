<?php

namespace Xigemall\UserSso;

use Illuminate\Support\ServiceProvider;
use Xigemall\UserSso\Services\Curl;

class CurlServiceProvider extends ServiceProvider
{

    /**
     * 是否延时加载提供器。
     *
     * @var bool
     */
    protected $defer = true;
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->singleton('UserSsoCurl',Curl::class);
    }

    /**
     * 获取提供器提供的服务。
     *
     * @return array
     */
    public function provides()
    {
        return ['UserSsoCurl'];
    }
}
