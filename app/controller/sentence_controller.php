<?php
namespace app\controller;
use \core\base\controller;
use app\model\sentences;
use core\base\functions;

class sentence_controller extends controller{

    /**
     * 获取一条台词
     */
    public function get(){
        $res = [];
        $res['status'] = 'failed';
        $this->assign($res, 400);

        $sentences = new sentences();
        $res = $sentences->get_rand();

        functions::get_redis()->incr('sentence_requested');

        if(isset($_GET['encode']) && $_GET['encode'] == 'text'){
            exit($res['content']);
        }
        $res['status'] = 'success';
        $this->assign($res, 200);
        $this->generate();
    }
}