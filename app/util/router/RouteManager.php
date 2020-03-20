<?php declare(strict_types=1);

namespace app\util\router;

use FastRoute;


class RouteManager {

    private  FastRoute\Dispatcher $dispatcher;

    private array $ruleItem=[];


    public function __construct(/*$request*/)
    {

        $dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {
            $r->addRoute('GET', '/users', 'get_all_users_handler');
            // {id} 必须是一个数字 (\d+)
            $r->addRoute('GET', '/user/{id:\d+}', 'get_user_handler');
            //  /{title} 后缀是可选的
            $r->addRoute('GET', '/articles/{id:\d+}[/{title}]', 'get_article_handler');
        });


        var_dump($dispatcher);
        /*var_dump($request->header);

        $httpMethod = $request->getMethod;
        $uri = $_SERVER['REQUEST_URI'];

        // Strip query string (?foo=bar) and decode URI
        if (false !== $pos = strpos($uri, '?')) {
            $uri = substr($uri, 0, $pos);
        }
        $uri = rawurldecode($uri);

        $routeInfo = $dispatcher->dispatch($httpMethod, $uri);
        switch ($routeInfo[0]) {
            case FastRoute\Dispatcher::NOT_FOUND:
                // ... 404 Not Found
                break;
            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED:
                $allowedMethods = $routeInfo[1];
                // ... 405 Method Not Allowed
                break;
            case FastRoute\Dispatcher::FOUND:
                $handler = $routeInfo[1];
                $vars = $routeInfo[2];
                // ... call $handler with $vars
                break;
        }*/
    }


    public static function get($rule,$path){

    }

    public  function post($rule,$path){

    }
}
