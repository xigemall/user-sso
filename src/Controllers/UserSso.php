<?php
/**
 * Created by PhpStorm.
 * User: admin
 * Date: 2019-06-05
 * Time: 19:04
 */

namespace Xigemall\UserSso\Controllers;


use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Xigemall\UserSso\Facades\UserSsoCurl;

trait UserSso
{
    protected $url;
    protected $clientId;
    protected $clientSecret;
    protected $redirectUri;

    public function __construct()
    {
        $this->url = config('sso.url');
        $this->clientId = config('sso.client_id');
        $this->clientSecret = config('sso.client_secret');
        $this->redirectUri = config('sso.redirect_uri');
    }

    /**
     * 请求令牌
     * 授权时的重定向
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function ssoLogin()
    {
        $query = http_build_query([
            'client_id' => $this->clientId,
            'redirect_uri' => $this->redirectUri,
            'response_type' => 'code',
            'scope' => '',
        ]);
        return redirect($this->url . '/oauth/authorize?' . $query);
    }

    /**
     * 将授权码转换为访问令牌
     */
    public function callback(Request $request)
    {
        $code = $request->query('code');
        $url = $this->url.'/oauth/token';
        $data = [
            'grant_type' => 'authorization_code',
            'client_id' => $this->clientId,
            'client_secret' =>$this->clientSecret,
            'redirect_uri' => $this->redirectUri,
            'code' => $code,
        ];
        $response = UserSsoCurl::post($url, $data);

        return $response['access_token'];
    }
}