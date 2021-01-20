<?php
namespace app\controller;
use \core\base\controller;
use core\base\functions;

class statistic_controller extends controller{
    /**
     * 获取请求数据
     */
    public function get(){
        $res = [];
        $res['status'] = 'failed';
        $this->assign($res, 400);

        $redis = functions::get_redis();

        $data = [];
        $data['sentence'] = [];
        $data['sentence']['uploaded'] = $redis->get('sentence_uploaded');
        $data['sentence']['approved'] = $redis->get('sentence_approved');
        $data['sentence']['requested'] = $redis->get('sentence_requested');
        $data['wallpaper'] = [];
        $data['wallpaper']['approved'] = $redis->get('wallpaper_approved');
        $data['wallpaper']['requested'] = $redis->get('wallpaper_requested');

        $res['data'] = $data;
        $res['status'] = 'success';

        $this->assign($res, 200);
        $this->generate();
    }
}
