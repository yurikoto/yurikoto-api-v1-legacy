<?php

namespace core\base;

class api{
    private $data = array();
    private $response_code = 500;

    /**
     * 赋值
     * @param $data array 数据
     * @param $code int 状态码
     */
    public function assign($data, $code){
        $this->data = $data;
        $this->response_code = $code;
    }

    public function generate(){
        http_response_code($this->response_code);
        exit(json_encode($this->data, JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES));
    }
}