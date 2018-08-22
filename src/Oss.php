<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/21
 * Time: 下午4:38
 */
namespace Jameswang\Vod;

require __DIR__.'/../vendor/autoload.php';

use OSS\OssClient;
use OSS\Core\OssException;

class Oss
{
    private static $client;

    public function __construct($AccessKeyId, $AccessKeySecret, $Endpoint, $SecurityToke)
    {
        self::$client = self::init_oss_client($AccessKeyId, $AccessKeySecret, $Endpoint, $SecurityToke);
    }

    private static function init_oss_client($AccessKeyId, $AccessKeySecret, $Endpoint, $SecurityToken) {

        $ossClient = new OssClient($AccessKeyId, $AccessKeySecret, $Endpoint, false, $SecurityToken);
        $ossClient->setTimeout(86400*7);    // 设置请求超时时间，单位秒，默认是5184000秒, 建议不要设置太小，如果上传文件很大，消耗的时间会比较长
        $ossClient->setConnectTimeout(10);  // 设置连接超时时间，单位秒，默认是10秒
        return $ossClient;
    }

    public static function upload_local_file($Bucket, $FileName, $localFile) {

        return self::$client->uploadFile($Bucket, $FileName, $localFile);
    }

    public static function multiuploadFile($Bucket, $FileName, $localFile) {

        return self::$client->multiuploadFile($Bucket, $FileName, $localFile);
    }


}