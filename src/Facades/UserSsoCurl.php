<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-02
 * Time: 23:32
 */
namespace Xigemall\UserSso\Facades;


use Illuminate\Support\Facades\Facade;

class UserSsoCurl extends Facade
{
    protected static function getFacadeAccessor() {
        return 'UserSsoCurl';
    }
}