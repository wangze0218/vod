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

class UpdateVideoInfo extends Video
{

    // $arg['title']        // 视频标题(必填参数)
    // $arg['description']  // 视频源文件描述(可选);
    // $arg['cover_url']    // 自定义视频封面(可选)
    // $arg['tag']          // 视频标签，多个用逗号分隔(可选)
    // $arg['cate_id']      // 更改视频分类(可在点播控制台·全局设置·分类管理里查看分类ID
    public function boot($videoId,$arg=[]) {

        $request = new vod\UpdateVideoInfoRequest();
        $request->setVideoId($videoId);

        if(isset($arg['title']))$request->setTitle($arg['title']);        // 视频标题(必填参数)
        if(isset($arg['description'])) $request->setDescription($arg['description']);  // 视频源文件描述(可选);
        if(isset($arg['cover_url'])) $request->setCoverURL($arg['cover_url']);  // 自定义视频封面(可选)
        if(isset($arg['tag'])) $request->setTags($arg['tag']);  // 视频标签，多个用逗号分隔(可选)
        if(isset($arg['cate_id'])) $request->setTags($arg['cate_id']);  // 更改视频分类(可在点播控制台·全局设置·分类管理里查看分类ID：https://vod.console.aliyun.com/#/vod/settings/category)

        $request->setAcceptFormat('JSON');

        return $this->client->getAcsResponse($request);

    }


}