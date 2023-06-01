## 安装
添加如下内容到 `composer.json` 文件
```json
{
    "repositories": [
        {
            "type": "vcs",
            "url": "https://github.com/gumphp/think-filesystem"
        }
    ]
}
```

执行安装命令

> composer require gumphp/think-filesystem:dev-master

## 配置
```php
# config/filesystem.php
<?php
return [
    // 默认磁盘
    'default' => env('filesystem.driver', 'aws'),
    // 磁盘列表
    'disks' => [
        // 更多的磁盘配置信息
        'aws'  => [
            'type' => 'aws',
            'credentials' => [
                'key' => env('AWS.S3_KEY', ''),
                'secret' => env('AWS.S3_SECRET', ''),
            ],
            'version' => env('AWS.S3_VERSION', 'latest'),
            'region' => env('AWS.S3_REGION', 'us-west-2'),
            'bucket' => env('AWS.S3_BUCKET', ''),
            'prefix' => '/',
        ],
    ],
];
```

## 使用
```php
<?php
namespace app\controller;

use think\facade\Filesystem;

class Index
{
    public function index()
    {
        Filesystem::disk('aws')->put('/s3/remote/file.ext', file_get_contents('/path/yourfile.ext'));
    }
}
```