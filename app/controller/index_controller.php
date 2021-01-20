<?php
namespace app\controller;
use core\base\controller;

class index_controller extends controller{
    /**
     * default
     */
    public function get(){
        http_response_code(404);
        $res['status'] = 'failed';
        $res['error'] = 'Not found';

        $this->assign($res, 404);
        $this->generate();
    }
}