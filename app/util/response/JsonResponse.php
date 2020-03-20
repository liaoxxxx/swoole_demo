<?php declare(strict_types=1);

namespace app\util\response;

class JsonResponse implements ResponseInterface {

    private static array $successBody=[
        'code' =>200,
        'status' => 1,
        'success'=> 'success',
        'msg' => ' success',
        'data' => []
    ];

    private static array $errorBody=[
        'code' =>500,
        'status' => 0,
        'success'=> 'error',
        'msg' => 'error',
        'data' => []
    ];


    public static function getSuccessBody(){
        return self::$successBody;
    }
    public static function getErrorBody(){
        return self::$successBody;
    }

    public static function success(string $msg='success', $data=[]){
        $jsonBody=self::getSuccessBody();
        $jsonBody['msg']=$msg;
        $jsonBody['data']=$data;
        return json_encode( $jsonBody);
    }

    public static function error(string $msg='success', $data=[]){
        $jsonBody=self::getErrorBody();
        $jsonBody['msg']=$msg;
        $jsonBody['data']=$data;
        return  json_encode( $jsonBody);
    }
}
