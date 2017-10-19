# server-sdk-php-composer
Rong Cloud Server SDK in PHP for Composer. 

在原有基础v2.0.1上进行少量修改：  
1.错误处理全部修改为throw new Exception 调用者自己捕获处理  
2.新增聊天室保活服务  

## 安装

* 推荐通过 composer 安装，使用 composer.json 声明依赖，或者运行下面的命令：

```bash
$ composer require liaosy21/rongcloud-php-sdk
```

* 直接下载安装，SDK 没有依赖其他第三方库，可直接下载引入使用。

## 使用方法
```php
include 'RongCloud.php';
$appKey = 'appKey';
$appSecret = 'appSecret';
$jsonPath = "jsonsource/";
...
    $rongCloud = new \RongCloud\RongCloud($appKey,$appSecret);
    $token = $rongCloud->user()->getToken('userId1', 'username', 'http://www.rongcloud.cn/images/logo.png');;
...
```