<?php

use app\AutoConfig;
use app\Boot;
use app\util\request\Request;
use app\App;

class HttpServer
{
    public function __construct($rootPath)
    {

        // new httpServer的实例子
        require_once "vendor/autoload.php";
        $http = new Swoole\Http\Server("0.0.0.0", 9501);  // $http = new Swoole\Http\Server("127.0.0.1", 9501);
        if($http){
            echo  date('Y-m-d H:i:s')." :  \033[1;35;5;9m http server init success  \e[0m\n";
        }
        //初始化配置


        //启动组件
        $booter= new Boot($rootPath);
        // 创建根  app 实例
        /***********    **********/
        $RootApp= new App($booter->getUtilContainer());

        //监听 用户请求
        $http->on('request', function ($request, $response) use ($RootApp) {
            echo date('Y-m-d H:i:s')." :  \033[1;35;5;9m request in  \e[0m\n";

            //复制 APP 的实例
            $AppCloneInstance= clone $RootApp;
            //绑定  请求到
            $AppCloneInstance->bind(new Request($request),$response);

            // todo 前置中间件

            // todo  分配路由  处理业务

            // todo 后置中间件


            //销毁 APP副本实例
            $AppCloneInstance->__destruct();
            unset($AppCloneInstance);
            //$app=  new \app\App($request,$response);
            //var_dump($app);
            /*list($controller, $action) = explode('/', trim($request->server['request_uri'], '/'));
            if($controller==""){
                $controller="index";
            }
            if ($action==""){
                $action="index";
            }
            $controller= "\app\http\\controller\\".ucfirst($controller) ."Controller";*/
            /**
             * @var PDO
             */
           /* $dbConnector= DbConnector::getConnector();
            $statement = $dbConnector->prepare("show databases");
            $statement->execute();
            $result = $statement->fetchAll();*/
            //根据 $controller, $action 映射到不同的控制器类和方法

        });
        $http->start();

    }
}




echo date('Y-m-d H:i:s')." :  \033[1;35;5;9m start run  \e[0m\n";
new HttpServer(dirname(__FILE__));
