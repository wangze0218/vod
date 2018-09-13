<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/22
 * Time: 上午11:40
 */

namespace Jameswang\Vod\Boot;
require_once __DIR__ . '../aliyun-php-sdk/aliyun-php-sdk-core/Config.php';   // 假定您的源码文件和aliyun-php-sdk处于同一目录
use vod\Request\V20170321 as vod;
use Jameswang\Vod\Video;

class DeleteVideos extends Video
{

    public function boot($videoIds) {

        $request = new vod\DeleteVideoRequest();
        $request->setVideoIds($videoIds);   // 支持批量删除视频；videoIds为传入的视频ID列表，多个用逗号分隔
        $request->setAcceptFormat('JSON');

        return $this->client->getAcsResponse($request);

    }


}