# user-sso

##1 远程包
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
    
        // 自增key (字段的名称) 默认id
        'increment_key' => 'id',
    
        // 密码字段 默认password
        'password' => 'password',
    
        // 获取当前用户接口地址
        'current_user_path' => '/api/current_user',
];
```

##2 本地包

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
    
        // 自增key (字段的名称) 默认id
        'increment_key' => 'id',
    
        // 密码字段 默认password
        'password' => 'password',
    
        // 获取当前用户接口地址
        'current_user_path' => '/api/current_user',
];
```