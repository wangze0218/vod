<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/22
 * Time: 上午11:40
 */

namespace Jameswang\Vod\Boot;
require_once __DIR__ . '/../aliyun-php-sdk/aliyun-php-sdk-core/Config.php';   // 假定您的源码文件和aliyun-php-sdk处于同一目录
use vod\Request\V20170321 as vod;
use Jameswang\Vod\Video;

class GetVideoInfo extends Video
{

    // $videoId        // 视频标题(必填参数)
    // 获取视频信息
    public function boot($videoId) {

        $request = new vod\GetVideoInfoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');

        return $this->client->getAcsResponse($request);

    }


}