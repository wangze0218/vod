<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/21
 * Time: 下午3:57
 */
namespace Jameswang\Vod;
use Jameswang\Vod\Boot\DeleteVideos;
use Jameswang\Vod\Boot\GetPlayInfo;
use Jameswang\Vod\Boot\UpdateVideoInfo;
use Jameswang\Vod\Video;
use Jameswang\Vod\Oss;
use Jameswang\Vod\Boot\CreateUpoadVideo;
use Jameswang\Vod\Boot\GetPlayVideo;
use Jameswang\Vod\Boot\RefreshUpdateVideo;



class Vod
{
    private $accessKeyId;
    private $accessKeySecret;
    private $securityToken = null;

    public function __construct($config)
    {
        $this->accessKeyId = $config['accessKeyId'];
        $this->accessKeySecret = $config['accessKeySecret'];
        if(isset($config['securityToken'])) $this->securityToken = $config['securityToken'];

    }

    // $arg['title']        // 视频标题(必填参数)
    // $arg['file_name']    // 视频源文件名称，必须包含扩展名(必填参数)
    // $arg['description']  // 视频源文件描述(可选);
    // $arg['cover_url']    // 自定义视频封面(可选)
    // $arg['tag']          // 视频标签，多个用逗号分隔(可选)
    public function reserve_upload_video($arg)
    {
        $video = new CreateUpoadVideo($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $upload_mes = $video->boot($arg);

        return $upload_mes;
    }

    // $arg['title']        // 视频标题(必填参数)
    // $arg['file_name']    // 视频源文件名称，必须包含扩展名(必填参数)
    // $arg['description']  // 视频源文件描述(可选)
    // $arg['cover_url']    // 自定义视频封面(可选)
    // $arg['tag']          // 视频标签，多个用逗号分隔(可选)
    public function oss_upload_video($arg,$localFilePath)
    {
        $video = new CreateUpoadVideo($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $upload_mes = $video->boot($arg);

        $uploadAddress = json_decode(base64_decode($upload_mes->UploadAddress),1);
        $uploadAuth = json_decode(base64_decode($upload_mes->UploadAuth),1);

        $oss = new Oss($uploadAuth['AccessKeyId'], $uploadAuth['AccessKeySecret'], $uploadAddress['Endpoint'], $uploadAuth['SecurityToken']);

        $result = $oss::upload_local_file($uploadAddress['Bucket'], $uploadAddress['FileName'], $localFilePath);
        return $result;
    }

    // 获取播放凭证
    public function get_play_video($video_id)
    {
        $video = new GetPlayVideo($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $res = $video->boot($video_id);
        return $res;
    }

    // 获取播放地址
    public function get_play_info($video_id)
    {
        $video = new GetPlayInfo($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $res = $video->boot($video_id);
        return $res;
    }

    // 刷新上传凭证
    public function refresh_update_video($video_id)
    {
        $video = new RefreshUpdateVideo($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $res = $video->boot($video_id);
        return $res;
    }

    // 修改视频信息 $video_id
    // $arg['title']        // 视频标题(必填参数)
    // $arg['description']  // 视频源文件描述(可选);
    // $arg['cover_url']    // 自定义视频封面(可选)
    // $arg['tag']          // 视频标签，多个用逗号分隔(可选)
    // $arg['cate_id']      // 更改视频分类(可在点播控制台·全局设置·分类管理里查看分类ID
    public function update_video_info($video_id,$arg)
    {
        $video = new UpdateVideoInfo($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $res = $video->boot($video_id,$arg);
        return $res;
    }

    // 删除视频
    public function delete_videos($video_ids)
    {
        $video = new DeleteVideos($this->accessKeyId,$this->accessKeySecret,$this->securityToken);
        $res = $video->boot($video_ids);
        return $res;
    }
}