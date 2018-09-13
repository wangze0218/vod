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

class CreateUpoadVideo extends Video
{

    // $arg['title']        // 视频标题(必填参数)
    // $arg['file_name']    // 视频源文件名称，必须包含扩展名(必填参数)
    // $arg['description']  // 视频源文件描述(可选);
    // $arg['cover_url']    // 自定义视频封面(可选)
    // $arg['tag']          // 视频标签，多个用逗号分隔(可选)
    public function boot($arg) {

        $request = new vod\CreateUploadVideoRequest();

        $request->setTitle($arg['title']);        // 视频标题(必填参数)
        $request->setFileName($arg['file_name']);        // 视视频源文件名称，必须包含扩展名(必填参数)

        if(isset($arg['description'])) $request->setDescription($arg['description']);  // 视频源文件描述(可选);
        if(isset($arg['cover_url'])) $request->setCoverURL($arg['cover_url']);  // 自定义视频封面(可选)
        if(isset($arg['tag'])) $request->setTags($arg['tag']);  // 视频标签，多个用逗号分隔(可选)
        $request->setAcceptFormat('JSON');

        return $this->client->getAcsResponse($request);

    }


}