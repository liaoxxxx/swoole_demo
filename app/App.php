<?php declare(strict_types=1);

namespace app;

use app\util\databases\DbConnector;
use app\util\router\RouteManager;
use app\util\request\RequestInterface;

class App{

    public function __construct(array $container){

        $this->setDbConnector($container['DbConnectorPool']);
        $this->setRouteManager($container['RouteManager']);
        //路由
        //缓存
        //数据库
        //json响应
        //html视图
        //控制台日志
        //文件日志
    }

    private static RequestInterface $request;        //请求容器

    private static $response;       //响应容器

    private static RouteManager $routeManager;         //路由

    private $cacheDriver;           //缓存数据库驱动

    private $DbConnector;


    private $jsonResponce;          //json响应

    private $view;                  //html视图

    private $consoleLoger;          //控制台日志

    private $fileLoger;             //文件日志

    /**
     * @param RequestInterface $request
     * @param $response
     */
    public function bind(RequestInterface $request,$response){
        self::setRequest($request);
        self::setResponse($response);
    }


    /**
     * @return mixed
     */
    public  function getRequest():RequestInterface
    {
        return self::$request;
    }

    /**
     * @param mixed $request
     */
    private static function setRequest($request): void
    {
        self::$request = $request;
    }

    /**
     * @return mixed
     */
    public static function getResponse()
    {
        return self::$response;
    }

    /**
     * @param mixed $response
     */
    private static function setResponse($response): void
    {
        self::$response = $response;
    }

    /**
     * @return RouteManager
     */
    public  function getRouteManager():RouteManager
    {
        return self::$routeManager;
    }

    /**
     * @param $routeManager
     */
    private static function setRouteManager($routeManager): void
    {
        self::$routeManager = $routeManager;
    }

    /**
     * @return mixed
     */
    public function getCacheDriver()
    {
        return $this->cacheDriver;
    }

    /**
     * @param mixed $cacheDriver
     */
    private function setCacheDriver($cacheDriver): void
    {
        $this->cacheDriver = $cacheDriver;
    }

    /**
     * @return mixed
     */
    public function getDbConnector():DbConnector
    {
        return $this->DbConnector;
    }

    /**
     * @param mixed $DbConnectorPool
     */
    private function setDbConnector($DbConnector): void
    {
        $this->DbConnectorPool = $DbConnector;
    }              //关系数据库驱动

    /**
     * @return mixed
     */
    public function getJsonResponce()
    {
        return $this->jsonResponce;
    }

    /**
     * @param mixed $jsonResponce
     */
    private function setJsonResponce($jsonResponce): void
    {
        $this->jsonResponce = $jsonResponce;
    }

    /**
     * @return mixed
     */
    public function getView()
    {
        return $this->view;
    }

    /**
     * @param mixed $view
     */
    private function setView($view): void
    {
        $this->view = $view;
    }

    /**
     * @return mixed
     */
    public function getConsoleLoger()
    {
        return $this->consoleLoger;
    }

    /**
     * @param mixed $consoleLoger
     */
    private function setConsoleLoger($consoleLoger): void
    {
        $this->consoleLoger = $consoleLoger;
    }

    /**
     * @return mixed
     */
    public function getFileLoger()
    {
        return $this->fileLoger;
    }

    /**
     * @param mixed $fileLoger
     */
    private function setFileLoger($fileLoger): void
    {
        $this->fileLoger = $fileLoger;
    }

    //销毁  app实例
    public function  __destruct(){
        // todo  回收数据库 ，缓存 到连接池
        //unset($this);

    }
}


