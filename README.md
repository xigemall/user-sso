# user-sso 三方登陆

## 1 远程包
## install
`composer require xigemall/user-sso`

## configure
`php artisan vendor:publish --provider="Xigemall\UserSso\UserSsoServiceProvider"`

## add to your config/auth.php
```php
'guards' => [
    'api' => [
        'driver' => 'sso',
        'provider' => 'sso',
    ],
],
'providers' => [
    'sso' => [
        'driver' => 'sso',
    ]
],
```

## update to your config/sso.php
```php
return [
    // 单点登录地址
    'url' => env('SSO_URL', 'http://localhost'),

    // client_id(客户端ID)
    'client_id' => env('CLIENT_ID', 1),

    // client_secret(客户端密钥)
    'client_secret' => env('CLIENT_SECRET', ''),

    // redirect_uri 授权时的重定向
    'redirect_uri'=>env('REDIRECT_URI','http://localhost/callback'),

    // 自增key (字段的名称) 默认id
    'increment_key' => 'id',

    // 密码字段 默认password
    'password' => 'password',

    // 获取当前用户接口地址
    'current_user_path' => '/api/current_user',   
];
```

## 2 本地包

### 1.项目根目录添加packages/xigemall目录
```$xslt
project 
    app
    config
    packages //添加
        xigemall //添加
            user-sso //扩展包（github下载的该项目）
    composer.json

```

### 2.在项目（project）的composer.json添加repositories

```$php
"repositories": [
        {
            "type": "path",
            "url": "packages/xigemall/user-sso"
        }
    ],

```

## 3.install
`composer require xigemall/user-sso`

## 4.configure
`php artisan vendor:publish --provider="Xigemall\UserSso\UserSsoServiceProvider"`

## add to your config/auth.php
```php
'guards' => [
    'api' => [
        'driver' => 'sso',
        'provider' => 'sso',
    ],
],
'providers' => [
    'sso' => [
        'driver' => 'sso',
    ]
],
```

## update to your config/sso.php
```php
return [
         // 单点登录地址
            'url' => env('SSO_URL', 'http://localhost'),
        
            // client_id(客户端ID)
            'client_id' => env('CLIENT_ID', 1),
        
            // client_secret(客户端密钥)
            'client_secret' => env('CLIENT_SECRET', ''),
        
            // redirect_uri 授权时的重定向
            'redirect_uri'=>env('REDIRECT_URI','http://localhost/callback'),
        
            // 自增key (字段的名称) 默认id
            'increment_key' => 'id',
        
            // 密码字段 默认password
            'password' => 'password',
        
            // 获取当前用户接口地址
            'current_user_path' => '/api/current_user',
];
```

### 获取用户（前端请求headers添加Authorization）

```php
    $response = $client->request('GET', '/api/user', [
        'headers' => [
            'Accept' => 'application/json',
            'Authorization' => 'Bearer '.$accessToken,
        ],
    ]);

```

### 三方登陆

```angular2html
授权登陆地址(获取code)
    /api/redirect

回调地址（获取accessToken）
    /api/access_token
```

### 重写登陆
```php
class SsoController extends Controller
{
    use UserSso;
    /**
     * 请求令牌
     * 授权时的重定向
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function redirect()
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
        $code = $request->code;
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
```