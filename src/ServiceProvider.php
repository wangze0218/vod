<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 2018/8/21
 * Time: 下午5:08
 */

namespace Jameswang\Vod;


class ServiceProvider
{
    protected $defer = false;

    public function register()
    {
        $this->app->singleton(Vod::class, function(){
            return new Vod(config('services.aliyun-vod'));
        });

        $this->app->alias(Vod::class, 'aliyun-vod');
    }

    public function provides()
    {
        return [Vod::class, 'aliyun-vod'];
    }
}