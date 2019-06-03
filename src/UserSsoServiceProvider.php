<?php

namespace Xigemall\UserSso;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\ServiceProvider;
use Xigemall\UserSso\Services\SsoGuard;
use Xigemall\UserSso\Services\SsoUserProvider;

class UserSsoServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        $this->publishes([
            __DIR__.'/../config/sso.php' => config_path('sso.php'),
        ]);
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        Auth::extend('sso', function ($app, $name, array $config) {
            // 返回一个 Illuminate\Contracts\Auth\Guard 实例...

            return new SsoGuard(Auth::createUserProvider($config['provider']));
        });
        Auth::provider('sso', function ($app, array $config) {
            // 返回 Illuminate\Contracts\Auth\UserProvider 实例...

            return new SsoUserProvider();
        });
    }
}
