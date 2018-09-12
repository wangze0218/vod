<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/22
 * Time: 上午11:40
 */

namespace Jameswang\Vod;
require_once __DIR__.'/aliyun-php-sdk/aliyun-php-sdk-core/Config.php';   // 假定您的源码文件和aliyun-php-sdk处于同一目录
use vod\Request\V20170321 as vod;
use Jameswang\Vod\Video;

class GetPlayVideo extends Video
{

    // $videoId        // 视频标题(必填参数)

    public function boot($videoId) {

        $request = new vod\GetVideoPlayAuthRequest();

        $request->setVideoId($videoId);
        $request->setAuthInfoTimeout(3600);  // 播放凭证过期时间，默认为100秒，取值范围100~3600；注意：播放凭证用来传给播放器自动换取播放地址，凭证过期时间不是播放地址的过期时间
        $request->setAcceptFormat('JSON');

        return $this->client->getAcsResponse($request);

    }


}