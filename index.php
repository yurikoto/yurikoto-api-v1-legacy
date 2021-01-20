<?php
/**
 * Yurikoto API
 * @version 1.0.0
 * @author van_fantasy
 * @since 2020.12.31
 */

// 百合大法好，百合保我代码无bug

include_once 'cors.php';

session_start();
define('APP_PATH', __DIR__ . '/');

error_reporting(0);

// define('APP_DEBUG', true);

$config = require(APP_PATH . 'config/config.php');

require(APP_PATH . 'core/core.php');

try{
    (new core\Core($config))->run();
    $error = error_get_last();
    if($error){
        throw new Exception($error['message']);
    }
}
catch (Exception $e){
    http_response_code(500);
    exit('{"status":"failed","error":"Internal error"}');
}
exit();
//// (new core\Core($config))->run();