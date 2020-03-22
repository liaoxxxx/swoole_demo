<?php

use app\Boot;
use app\util\request\Request;
use app\App;


class HttpServer
{
    public function __construct($rootPath)
    {
        // new httpServer的实例
        require_once "vendor/autoload.php";
        $http = new Swoole\Http\Server("0.0.0.0", 9501);  // $http = new Swoole\Http\Server("127.0.0.1", 9501);
        if($http){
            echo  date('Y-m-d H:i:s')." :  \033[1;35;5;9m http server init success  \e[0m\n";
        }
        //启动组件
        $booter= new Boot($rootPath);
        // 创建根  app 实例
        $RootApp= new App($booter->getUtilContainer());
        //监听 用户请求
        $http->on('request', function ($request, $response) use ($RootApp) {
            echo date('Y-m-d H:i:s')." :  \033[1;35;5;9m request in  \e[0m\n";
            //复制 APP 的实例
            echo "    当前脚本运行所用的内存 ";
            echo $m1 = memory_get_usage()."\r\n";     //输出这个php文件占用的内存大小
            $AppCloneInstance= clone $RootApp;
            echo '    clone  $AppCloneInstance 所用的内存 ';
            echo $m2 = memory_get_usage()-$m1. "\r\n";

            //绑定  请求到
            $AppCloneInstance->bind(  new Request($request),$response);

            // todo 前置中间件
            var_dump('分配路由  处理业务');
            $AppCloneInstance->getRouteManager()->handle($AppCloneInstance->getRequest(),$response);
            // todo 后置中间件
            //销毁 APP副本实例
            $AppCloneInstance->__destruct();
            unset($AppCloneInstance);
        });
        $http->start();
    }
}


echo date('Y-m-d H:i:s')." :  \033[1;35;5;9m start run  \e[0m\n";
new HttpServer(dirname(__FILE__));
