<?php declare(strict_types=1);

namespace app\util\router;

use app\util\request\Request;
use app\util\request\RequestInterface;
use FastRoute;


class RouteManager {


    /*private array $ruleItem=[];*/

    public function __construct(/*$request*/)
    {
        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/', '/index/index');
            $r->addRoute('GET', '/users', '/user/index');
            // {id} 必须是一个数字 (\d+)
            $r->addRoute('GET', '/user/edit/{id:\d+}', '/user/edit/');
            //  /{title} 后缀是可选的
            $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', '/articles/find');
        });
        $this->dispatcher=$dispatcher;
    }
    //处理请求
    public function handle(Request $request , $response):void {
        $this->checkRoute($request,$response);
    }


    //分配到控制器 -> 方法

    public  function dispatch(Request $request, $responce, string $handler ,array $params){
        var_dump("路由正确 ，将进行分配");
        var_dump("----- request uri ----");
        var_dump($request->getRequestUrI() );
        var_dump("----- handler ----");
        var_dump($handler );
        var_dump("----- vars ----");
        var_dump($params);
        $handler =trim($handler,"/");
        var_dump("-----trim 后的  handler ----");
        var_dump($handler);
        list($controller, $action) = explode('/', $handler);
        var_dump("----- controller ---- action ---");
        var_dump($controller);
        var_dump($action);
        $controller= "\app\http\\controller\\".ucfirst($controller) ."Controller";
        (new $controller)->$action($request,$responce);
    }

    //检测路由
    public function checkRoute(Request $request,$response){
        $httpMethod = $request->getMethod();
        $uri = $request->getRequestUrI();
        var_dump('-------路由检测-----');
        var_dump($httpMethod."  --------   ".$uri);
        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);
        $routeInfo =$this->dispatcher->dispatch($httpMethod, $uri);
        var_dump('------$routeInfo');
        var_dump($routeInfo);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found var_dump( $routeInfo[0]);
                var_dump("路由不存在");
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                var_dump("路由正确 ，访问方法不允许");  // $allowedMethods = $routeInfo[1];// ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $params = $routeInfo[2];
                //分配路由
                $this->dispatch($request,$response, $handler,$params);
                break;
            default:
                echo "switch default";
                break;
        }
    }


    public static function get($rule,$path){

    }

    public  function post($rule,$path){

    }
}
