<?php


Route::namespace('Xigemall\UserSso\Controllers')->prefix('api')->group(function () {
    // 请求令牌
    Route::get('/redirect', 'SsoController@redirect');
    //将授权码转换为访问令牌
    Route::get('/access_token', 'SsoController@getAccessToken');
});
