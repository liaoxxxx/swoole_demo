<?php

namespace app\http\controller;
use app\util\response\JsonResponse;
use app\util\view\View;

class IndexController {


    public  function __construct()
    {
    }

    public function index($request, $response){

        $foo='bar';
        $view= View::display("",['foo'=>$foo]);
         $response->end($view);
    }

    public function add($request, $response){
        $view= View::display("",[]);
    }

}

