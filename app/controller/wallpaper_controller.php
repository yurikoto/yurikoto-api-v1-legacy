<?php
namespace app\controller;
use app\model\wallpapers;
use \core\base\controller;
use core\base\functions;

class wallpaper_controller extends controller{

    /**
     * 适合白天的壁纸
     */
    public function day(){
        $res = [];
        $res['status'] = 'failed';
        $this->assign($res, 400);

        $wallpapers = new wallpapers();
        $res = $wallpapers->get_rand_by_type('day');

        $this->show($res);
    }

    /**
     * 适合夜晚的壁纸
     */
    public function night(){
        $res = [];
        $res['status'] = 'failed';
        $this->assign($res, 400);

        $wallpapers = new wallpapers();
        $res = $wallpapers->get_rand_by_type('night');

        $this->show($res);
    }

    /**
     * 默认
     */
    public function get(){
        $res = [];
        $res['status'] = 'failed';
        $this->assign($res, 400);

        $wallpapers = new wallpapers();
        $res = $wallpapers->get_rand();

        $this->show($res);
    }

    private function show($res){
        functions::get_redis()->incr('wallpaper_requested');

        if(isset($_GET['encode']) && $_GET['encode'] == 'text'){
            // http_response_code(200);
            exit($res['link']);
        }
        elseif(isset($_GET['encode']) && $_GET['encode'] == 'json'){
            $res['status'] = 'success';
            $this->assign($res, 200);
            $this->generate();
        }
        else{
            http_response_code(302);
            header("Location: " . $res['link']);
        }
    }
}