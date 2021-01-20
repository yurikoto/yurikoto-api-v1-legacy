<?php
namespace core\base;

use Redis;

class functions{
    /**
     * 获取客户端ip
     * @return mixed ip地址
     */
    public static function get_ip(){
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {
            return $_SERVER['HTTP_CLIENT_IP'];
        } elseif (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {
            return $_SERVER['HTTP_X_FORWARDED_FOR'];
        } else {
            return $_SERVER['REMOTE_ADDR'];
        }
    }

    /**
     * 发送post请求
     * @param $url string 请求url
     * @param $post_data array 请求数据
     * @return array 返回数据
     */
    public static function post($url, $post_data){
        $postdata = http_build_query($post_data);
        $options = array(
            'http' => array(
                'method' => 'POST',
                'header' => 'Content-type:application/x-www-form-urlencoded',
                'content' => $postdata,
                'timeout' => 15
            )
        );
        $context = stream_context_create($options);
        $result = file_get_contents($url, false, $context);
        // echo $result;
        return json_decode($result, true);
        // return $result;
    }

    /**
     * 初始化Redis
     * @return Redis
     */
    public static function get_redis(){
        $redis = new Redis();
        $redis->connect('localhost', 6379);
        return $redis;
    }
}