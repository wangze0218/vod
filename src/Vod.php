<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/21
 * Time: 下午3:57
 */
namespace Jameswang\Vod;
use Jameswang\Vod\Video;
use Jameswang\Vod\Oss;

class Vod
{
    private $accessKeyId;
    private $accessKeySecret;

    public function __construct($config)
    {
        $this->accessKeyId = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
    }

    // $arg['title']        // 视频标题(必填参数)
    // $arg['file_name']    // 视频源文件名称，必须包含扩展名(必填参数)
    // $arg['description']  // 视频源文件描述(可选);
    // $arg['cover_url']    // 自定义视频封面(可选)
    // $arg['tag']          // 视频标签，多个用逗号分隔(可选)
    public function upload_video($arg,$localFilePath)
    {
        $video = new CreateUpoadVideo($this->accessKeyId,$this->accessKeySecret);
        $upload_mes = $video->boot($arg);

        $uploadAddress = json_decode(base64_decode($upload_mes->UploadAddress),1);
        $uploadAuth = json_decode(base64_decode($upload_mes->UploadAuth),1);

        $oss = new Oss($uploadAuth['AccessKeyId'], $uploadAuth['AccessKeySecret'], $uploadAddress['Endpoint'], $uploadAuth['SecurityToken']);

        $result = $oss::upload_local_file($uploadAddress['Bucket'], $uploadAddress['FileName'], $localFilePath);
        return $result;
    }
}