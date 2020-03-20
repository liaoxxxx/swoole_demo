<?php

namespace app\http\controller;
use app\util\view\View;
use app\util\response\JsonResponse;

class GoodsController {


    public  function __construct()
    {
    }


    public function add($request, $response){
        return View::display("",[]);
    }

     public function edit($request, $response){
            return JsonResponse::success('编辑成功',['id'=>001,"name"=>'goods name is empty']);
     }

}

