<?php declare(strict_types=1);

namespace app\util\response;

Interface ResponseInterface{


    public static function success(string $msg ,$data =[]);

    public static function error(string $msg ,$data =[]);
}
