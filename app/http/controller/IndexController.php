<?php


namespace app\http\controller;
use app\util\view\View;
class IndexController {


    public  function __construct()
    {
    }

    public function index($request, $response){
        $view= View::display("",[]);
    }

    public function add($request, $response){
        $view= View::display("",[]);
    }

}

