<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/21
 * Time: 下午5:28
 */
require __DIR__ .'/vendor/autoload.php';

use Jameswang\Vod\Vod;

$config = [
    'accessKeyId'=>"",
    'accessKeySecret'=>"",
];
$path = '/Users/james/Downloads/aa.mp4';

$vod = new Vod($config);

// $arg['title']        // 视频标题(必填参数)
// $arg['file_name']    // 视频标题(必填参数)
// $arg['description']  // 视频源文件描述(可选);
// $arg['cover_url']    // 自定义视频封面(可选)
// $arg['tag']          // 视频标签，多个用逗号分隔(可选)
$arg['title'] = '';
$arg['file_name'] = '';
//只获取上传凭证
//$result = $vod->reserve_upload_video($arg);
//注册带上传
//$result = $vod->oss_upload_video($arg,$path);

//获取播放凭证
//$result = $vod->get_play_video('xxxxx81f25e6490d9d76ec7101axxxxx');



echo '<pre>';
var_dump($result);
echo '</pre>';