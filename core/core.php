<?php
namespace core;
use core\base\functions;

defined('CORE_PATH') or define('CORE_PATH', __DIR__);

/**
 * Class core
 */
class Core{
    /**
     * @var array configuration array
     */
    protected $config;

    /**
     * Core constructor.
     * @param $config array configuration array
     */
    public function __construct($config){
        $this->config = $config;
    }

    /**
     * Load configurations, route and run
     */
    public function run(){
        spl_autoload_register(array($this, 'loadClass'));
        $this->limit_check();
        $this->set_basic_config();;
        $this->set_db_config();
        $this->route();
    }

    /**
     * Load basic configurations
     */
    private function set_basic_config(){
        if($this->config['basic_info']){
            define('BASE_TITLE', $this->config['basic_info']['title']);
            define('BASE_URL', $this->config['basic_info']['url']);
        }
    }

    /**
     * Load database(PDO) configurations
     */
    private function set_db_config(){
        if($this->config['db_info']){
            define('DB_HOST', $this->config['db_info']['host']);
            define('DB_NAME', $this->config['db_info']['db_name']);
            define('DB_USER', $this->config['db_info']['username']);
            define('DB_PASS', $this->config['db_info']['pwd']);
            define('DB_PREFIX', $this->config['db_info']['prefix']);
            define('DB_PORT', $this->config['db_info']['port']);
            define('DB_CHARSET', $this->config['db_info']['charset']);
        }
    }

    /**
     * Check if current ip exceeded request limit
     */
    private function limit_check(){
        $key= 'request_count_' . functions::get_ip();
        $redis = functions::get_redis();
        $exists = $redis->exists($key);
        $redis->incr($key);

        if($exists){
            $count = $redis->get($key);

            // 这个incr简直太诡异了，每次都加二，不知道原因，希望这背后没有大问题
            // 后续：莫名其妙的好了
            if($count > $this->config['request_limit']['limit']){
                http_response_code(429);
                $res['status'] = 'failed';
                $res['error'] = 'Too many requests';
                exit(json_encode($res));
            }
        }
        else{
            // 首次计数 设定过期时间
            $redis->expire($key, $this->config['request_limit']['ttl']);
            // exit();
        }
    }

    /**
     * Get the controller and action and execute
     */
    private function route(){
        $controller_name = $this->config['basic_info']['default_controller'];
        $action_name = $this->config['basic_info']['default_action'];
        $param = array();
        // echo $controller_name . " " . $action_name;

        $url = $_SERVER['REQUEST_URI'];
        $position = strpos($url, '?');
        $url = $position === false ? $url : substr($url, 0, $position);

        $position = strpos($url, 'index.php');
        if ($position !== false){
            $url = substr($url, $position + strlen('index.php'));
        }
        
        $url = trim($url, '/');

        if ($url){
            $url_array = explode('/', $url);
            $url_array = array_filter($url_array);

            $controller_name = $url_array[0];

            array_shift($url_array);
            $action_name = $url_array ? $url_array[0] : $action_name;

            array_shift($url_array);
            $param = $url_array ? $url_array : array();
        }

        $controller = 'app\\controller\\'. $controller_name . '_controller';
        if (!class_exists($controller) || !method_exists($controller, $action_name)){
            $controller_name = $this->config['basic_info']['default_controller'];
            $action_name = $this->config['basic_info']['default_action'];
            $controller = 'app\\controller\\' . $controller_name . '_controller';
        }

        $dispatch = new $controller($controller_name, $action_name);
        call_user_func_array(array($dispatch, $action_name), $param);

    }


    /**
     * Class loader
     * @param $class_name string class name
     */
    public function loadClass($class_name){
        if(strpos($class_name, '\\') !== false){
            $file = APP_PATH . str_replace('\\', '/', $class_name) . '.php';
            if(!is_file($file)){
                return;
            }
        }
        else{
            return;
        }

        include $file;
    }
}