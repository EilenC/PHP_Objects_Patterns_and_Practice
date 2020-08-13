<?php
// 注册表模式 类似单例模式
namespace woo\controller;
class Request{}
class Registry
{
    private static $instance;
    private $request;

    private function __construct(){}

    static function instance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }
        return self::$instance;
    }

    function getRequest()
    {
        return $this->request;
    }

    function setRequest(Request $request)
    {
        $this->request = $request;
    }
}
