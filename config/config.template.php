<?php
/**
 * 配置文件
 * 需要将本文件名修改为 config.php 以生效。
 * 如果需要自托管，请填写本配置文件，并参考 https://github.com/yurikoto/yurikoto-resources 导入数据库。
 */
return array(
    // MySQL configuration
    'db_info' => array(
        'host' => 'localhost',
        'port' => '3306',
        'db_name' => '',
        'username' => '',
        'pwd' => '',
        'charset' => 'utf8',
        'prefix' => 'yuri_'
    ),
    // basic configuration
    'basic_info' => array(
        'title' => 'Yurikoto',
        'url' => 'https://yurikoto.com',
        'default_controller' => 'index',
        'default_action' => 'get'
    ),
    'request_limit' => array(
        'ttl' => 60,
        'limit' => 100
    )
);