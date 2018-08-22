<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/21
 * Time: 下午3:15
 */

namespace Jameswang\Vod;

require_once __DIR__.'/aliyun-php-sdk/aliyun-php-sdk-core/Config.php';   // 假定您的源码文件和aliyun-php-sdk处于同一目录
use vod\Request\V20170321 as vod;
use DefaultProfile;
use DefaultAcsClient;

abstract class Video
{
    protected $client;

    public function __construct($accessKeyId, $accessKeySecret)
    {
        $this->client = $this->init_vod_client($accessKeyId, $accessKeySecret);
    }

    private function init_vod_client($accessKeyId, $accessKeySecret) {
        $regionId = 'cn-shanghai';  // 点播服务所在的Region，国内请填cn-shanghai，不要填写别的区域
        $profile = DefaultProfile::getProfile($regionId, $accessKeyId, $accessKeySecret);
        return new DefaultAcsClient($profile);
    }

    public function refresh_upload_video($videoId) {
        $request = new vod\RefreshUploadVideoRequest();
        $request->setVideoId($videoId);
        $request->setAcceptFormat('JSON');
        return $this->client->getAcsResponse($request);
    }

    public function create_upload_image($imageType, $imageExt) {
        $request = new vod\CreateUploadImageRequest();
        $request->setImageType($imageType);
        $request->setImageExt($imageExt);
        $request->setAcceptFormat('JSON');
        return $this->client->getAcsResponse($request);
    }

    abstract public function boot($arg);

}