<?php

namespace app\util\view;

class View {
    public static function display($viewPath,$assignArray=[]){
        if (is_array($assignArray)) {
            foreach ($assignArray as $key => $value) {
                $$key = $value;
            }
        }
        $viewPath='goods/add.html';
        return   file_get_contents(  '/www/wwwroot/swoole_demo/template/goods/add.php');//.$viewPath;
    }
}
