<?php declare(strict_types=1);

namespace app;


use app\util\databases\DbConnector;
use app\util\router\RouteManager;

class Boot{

    private  array $utilContainer =[
        'DbConnectorPool' =>null,
        'RouteManager'=>null
    ];


    public function __construct(String $rootPath)
    {
        $GLOBALSConfig=new AutoConfig($rootPath);
        //数据库连接池
        $dbConnector=new DbConnector($GLOBALSConfig->getConfigs()['dbConfig']);
        $this-> putUtilToContainerByKey('DbConnectorPool' ,$dbConnector);
        //路由管理器
        $routeManager=new RouteManager();
        $this->putUtilToContainerByKey('RouteManager',$routeManager);
    }

    public function getUtilContainer(){
        return $this->utilContainer;
    }
    private function putUtilToContainerByKey(string $key,$util){
        $this->utilContainer[$key]=$util;
    }
}
