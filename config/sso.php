<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-02
 * Time: 23:16
 */

return [

    // 单点登录地址
    'url' => env('SSO_URL', 'http://localhost'),

    // 自增key (字段的名称) 默认id
    'increment_key' => 'id',

    // 密码字段 默认password
    'password' => 'password',

    // 获取当前用户接口地址
    'current_user_path' => '/api/current_user',
];