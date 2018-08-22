<h1 align="center"> vod </h1>

<p align="center"> 这是阿里云点播sdk进一步封装，适用于laravel.</p>
<p align="center"> 目前只含有 上传功能 </p>

## Installing

```shell
$ composer require jameswang/vod -vvv
```

## Usage

TODO

## Contributing

You can contribute in one of three ways:

1. File bug reports using the [issue tracker](https://github.com/jameswang/vod/issues).
2. Answer questions or fix bugs on the [issue tracker](https://github.com/jameswang/vod/issues).
3. Contribute new features or update the wiki.

_The code contribution process is not very formal. You just need to make sure that you follow the PSR-0, PSR-1, and PSR-2 coding guidelines. Any new code contributions must be accompanied by unit tests where applicable._

## License

MIT

##一般引入方式 

```shell
<?php
require __DIR__ .'/vendor/autoload.php';

use Jameswang\Vod\Vod;

$config = [
    'accessKeyId'=>"",
    'accessKeySecret'=>"",
];
$path = '/Users/james/Downloads/aa.mp4';

// $arg['title']        // 视频标题(必填参数)
// $arg['file_name']    // 视频源文件名称，必须包含扩展名(必填参数)
// $arg['description']  // 视频源文件描述(可选);
// $arg['cover_url']    // 自定义视频封面(可选)
// $arg['tag']          // 视频标签，多个用逗号分隔(可选)
$arg['title'] = '测试';
$arg['file_name'] = "aa.mp4";

$vod = new Vod($config);
$result = $vod->upload_video($arg,$path);
```

##Laravel 引入方式 

config/services.php
```shell
    'aliyun-vod' => [
        'accessKeyId' => env('VOD_ACCESS_KEY_ID'),
        'accessKeySecret' => env('VOD_ACCESS_KEY_SECRET'),
    ],
```
src/ServiceProvider.php
```shell
<?php
    namespace Jameswang\Vod;
    
    class ServiceProvider
    {
        protected $defer = true;
    
        public function register()
        {
            $this->app->singleton(Vod::class, function(){
                return new Vod(config('services.aliyun-vod'));
            });
    
            $this->app->alias(Vod::class, 'aliyun-vod');
        }
    
        public function provides()
        {
            return [Vod::class, 'aliyun-vod'];
        }

```

使用
```shell

```
