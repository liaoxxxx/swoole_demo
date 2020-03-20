<?php declare(strict_types=1);

namespace app;


use app\util\databases\DbConnector;

class Boot{

    private  array $utilContainer =[
        'DbConnectorPool' =>null,
    ];


    public function __construct(String $rootPath)
    {
        $GLOBALSConfig=new AutoConfig($rootPath);
        //
        $dbConnector=new DbConnector($GLOBALSConfig->getConfigs()['dbConfig']);
        $this-> putUtilToContainerByKey('DbConnector' ,$dbConnector);
    }

    public function getUtilContainer(){
        return $this->utilContainer;
    }
    private function putUtilToContainerByKey(string $key,$util){
        $this->utilContainer[$key]=$util;
    }
}
