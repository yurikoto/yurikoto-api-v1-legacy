<?php
namespace core\base;

class controller{
    protected $_controller;
    protected $_action;
    protected $_api;
    // protected $_view;

    public function __construct($controller, $action){
        $this->_controller = $controller;
        $this->_action = $action;
        $this->_api = new api();
        // $this->_view = new view();
    }

    public function assign($data, $code){
        $this->_api->assign($data, $code);
    }

    public function generate(){
        $this->_api->generate();
    }

    /*
    public function assign_view($data){
        $this->_view->assign($data);
    }

    public function generate_view(){
        $this->_view->render();
    }
    */
}
