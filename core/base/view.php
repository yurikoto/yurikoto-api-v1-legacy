<?php
namespace core\base;

class view
{
    protected $variables = array();

    // 分配变量
    public function assign($name, $value)
    {
        $this->variables[$name] = $value;
    }

    // 渲染显示
    public function render($layout)
    {
        extract($this->variables);
//        $defaultHeader = APP_PATH . 'app/views/header.php';
//        $defaultFooter = APP_PATH . 'app/views/footer.php';
//
//        $controllerHeader = APP_PATH . 'app/views/' . $this->_controller . '/header.php';
//        $controllerFooter = APP_PATH . 'app/views/' . $this->_controller . '/footer.php';
//        $controllerLayout = APP_PATH . 'app/views/' . $this->_controller . '/' . $this->_action . '.php';
        $controllerLayout = APP_PATH . 'app/view/' . $layout . '.php';
        include_once($controllerLayout);

//        // 页头文件
//        if (is_file($controllerHeader)){
//            include ($controllerHeader);
//        } else {
//            include ($defaultHeader);
//        }
//
//        //判断视图文件是否存在
//        if (is_file($controllerLayout)){
//            include ($controllerLayout);
//        } else {
//            echo "<h1>无法找到视图文件</h1>";
//        }
//
//        // 页脚文件
//        if (is_file($controllerFooter)){
//            include ($controllerFooter);
//        } else {
//            include ($defaultFooter);
//        }
    }
}
