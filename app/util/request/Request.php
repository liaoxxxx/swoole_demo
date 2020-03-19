<?php declare(strict_types=1);

namespace  app\util\request;

use Swoole\Http\Request  as swooleHttpRequest;
class Request{

    //https://wiki.swoole.com/#/http_server?id=httprequest
    private swooleHttpRequest $requester;


    public function  __construct(swooleHttpRequest $request)
    {
        $this->requester =$request;
    }


    public  function getHeader(){
        return $this-> requester->header;
    }

    public function getHost():string {
        return  $this->requester->header['host'];
    }


    public function getServer(){
        return $this->requester->server;
    }


    //Http 请求的 GET 参数，相当于 PHP 中的 $_GET，格式为数组。
    //      Swoole\Http\Request->get: array;
    // 如：index.php?hello=123
    //      echo $request->get['hello'];
    // 获取所有GET参数
    //      var_dump($request->get);
    public function getGetBody():array {
        return $this->requester->get;
    }


    //HTTP POST 参数，格式为数组
    //      Swoole\Http\Request->post: array;
    //示例
    //      echo $request->post['hello'];
    //注意
    //-POST 与 Header 加起来的尺寸不得超过 package_max_length 的设置，否则会认为是恶意请求
    public function getPostBody(){
        return $this->requester->post;
    }
    public function getCookie(){
        return $this->requester->cookie;
        //HTTP 请求携带的 COOKIE 信息，格式为键值对数组。
        //  Swoole\Http\Request->cookie: array;
        //示例
        //  echo $request->cookie['username'];

    }

    //      Swoole\Http\Request->files: array;  最大文件尺寸不得超过 package_max_length 设置的值。请勿使用 Swoole\Http\Server 处理大文件上传。
    //      Array
    //      (
    //          [name] => facepalm.jpg // 浏览器上传时传入的文件名称
    //          [type] => image/jpeg // MIME类型
    //          [tmp_name] => /tmp/swoole.upfile.n3FmFr // 上传的临时文件，文件名以/tmp/swoole.upfile开头
    //          [size] => 15476 // 文件尺寸
    //          [error] => 0
    //      )
    public function getFiles(){
        return $this->requester->files;
    }




    //  获取原始的 POST 包体。 用于非 application/x-www-form-urlencoded 格式的 Http POST 请求。返回原始 POST 数据，此函数等同于 PHP 的 fopen('php://input')
    public function getRowContent():string {
        return $this->requester->rawContent();
    }


    //获取完整的原始 Http 请求报文。包括 Http Header 和 Http Body
    public function getOriginData():string {
        return $this->requester-> getData();
    }
}
