<?php declare(strict_types=1);

namespace app;


class Boot{

    private  array $container;


    public function __construct($config)
    {

    }


    private function booting(){

    }

    public function getContainer(){
        return $this->container;
    }
}
