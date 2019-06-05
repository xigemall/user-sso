<?php


Route::namespace('Xigemall\UserSso\Controllers')->prefix('api')->group(function () {
    // 授权登陆
    Route::get('/sso_login', 'SsoController@ssoLogin');
    //将授权码转换为访问令牌
    Route::get('/callback', 'SsoController@callback');
});
