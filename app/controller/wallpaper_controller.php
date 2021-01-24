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
//    public function get(){
//        $res = [];
//        $res['status'] = 'failed';
//        $this->assign($res, 400);
//
//        $wallpapers = new wallpapers();
//
//        if(isset($_GET['type']) && $_GET['type'] == 'day'){
//            $res = $wallpapers->get_rand_by_type('day');
//        }
//        elseif(isset($_GET['type']) && $_GET['type'] == 'night'){
//            $res = $wallpapers->get_rand_by_type('night');
//        }
//        else{
//            $res = $wallpapers->get_rand();
//        }
//
//        $this->show($res);
//    }

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

    public function get(){
        $res = [];
        $res['status'] = 'failed';
        $this->assign($res, 400);

        $redis = functions::get_redis();
        $total_cnt = $redis->get('wallpaper_approved');
        $day_cnt = $redis->get('wallpaper_day_count');
        // $night_cnt = $redis->get('wallpaper_night_count');

        // $id = 1;

        if(isset($_GET['type']) && $_GET['type'] == 'day'){
            $id = rand(1, $day_cnt);
        }
        elseif(isset($_GET['type']) && $_GET['type'] == 'night'){
            $id = rand($day_cnt + 1, $total_cnt);
        }
        else{
            $id = rand(1, $total_cnt);
        }

        // $res['id'] = $id;
        $link = 'https://cdn.jsdelivr.net/gh/yurikoto/yurikoto-resources@master/wallpapers';

        functions::get_redis()->incr('wallpaper_requested');

        if($id <= $day_cnt){
            $link .= '/day/';
            $link .= str_pad($id, 4, "0", STR_PAD_LEFT);
            $link .= '.jpg';

            if(isset($_GET['encode']) && $_GET['encode'] == 'text'){
                http_response_code(200);
                exit($link);
            }
            elseif(isset($_GET['encode']) && $_GET['encode'] == 'json'){
                $res['status'] = 'success';
                $res['id'] = $id;
                $res['link'] = $link;
                $res['type'] = 'day';
                $this->assign($res, 200);
                $this->generate();
            }
            else{
                http_response_code(302);
                header("Location: " . $link);
            }
        }
        else{
            $link .= '/night/';
            $link .= str_pad($id - $day_cnt, 4, "0", STR_PAD_LEFT);
            $link .= '.jpg';

            if(isset($_GET['encode']) && $_GET['encode'] == 'text'){
                http_response_code(200);
                exit($link);
            }
            elseif(isset($_GET['encode']) && $_GET['encode'] == 'json'){
                $res['status'] = 'success';
                $res['id'] = $id - $day_cnt + 5000;
                $res['link'] = $link;
                $res['type'] = 'night';
                $this->assign($res, 200);
                $this->generate();
            }
            else{
                http_response_code(302);
                header("Location: " . $link);
            }
        }
    }
}