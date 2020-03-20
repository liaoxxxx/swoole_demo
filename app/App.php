<?php declare(strict_types=1);

namespace app;

use app\util\databases\DbConnector;
use app\util\router\RouteManager;
use app\util\request\RequestInterface;

class App{

    public function __construct(array $container){

        $this->setDbConnector($container['DbConnectorPool']);
        //路由
        //缓存
        //数据库
        //json响应
        //html视图
        //控制台日志
        //文件日志
    }





    public function bind(RequestInterface $request,$response){
        self::setRequest($request);
        self::setResponse($response);
        self::setRouter(new RouteManager(self::getRequest()));
        self::getRouter();

    }

    private static $request;        //请求容器

    private static $response;       //响应容器

    private static $router;         //路由

    private $cacheDriver;           //缓存数据库驱动

    private $DbConnector;


    private $jsonResponce;          //json响应

    private $view;                  //html视图

    private $consoleLoger;          //控制台日志

    private $fileLoger;             //文件日志

    /**
     * @return mixed
     */
    public static function getRequest()
    {
        return self::$request;
    }

    /**
     * @param mixed $request
     */
    public static function setRequest($request): void
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
    public static function setResponse($response): void
    {
        self::$response = $response;
    }

    /**
     * @return mixed
     */
    public static function getRouter()
    {
        return self::$router;
    }

    /**
     * @param mixed $router
     */
    public static function setRouter($router): void
    {
        self::$router = $router;
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
    public function setCacheDriver($cacheDriver): void
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
    public function setDbConnector($DbConnector): void
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
    public function setJsonResponce($jsonResponce): void
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
    public function setView($view): void
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
    public function setConsoleLoger($consoleLoger): void
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
    public function setFileLoger($fileLoger): void
    {
        $this->fileLoger = $fileLoger;
    }

    //销毁  app实例
    public function  __destruct(){
        // todo  回收数据库 ，缓存 到连接池
        //unset($this);

    }
}


