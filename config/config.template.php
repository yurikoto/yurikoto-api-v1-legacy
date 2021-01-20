<?php
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
    // vaptcha
    'vaptcha' => array(
        'id' => '',
        'secretkey' => '',
        'scene' => '0'
    ),
    'request_limit' => array(
        'ttl' => 60,
        'limit' => 100
    )
);