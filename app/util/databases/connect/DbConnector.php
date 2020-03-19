<?php
declare(strict_types =1);

namespace app\util\databases;

use Exception;

class DbConnector {


    /**
     *  const  DEFAULT_CONFIG
     */
    protected  const  DEFAULT_CONFIG= [

        'driverType'=>"mysql",

        'host' => "127.0.0.1",      // MySQL所在的服务器的IP

        'port' => "3306",           // MySQL的端口

        'username' => "root",       //数据库账号

        'password' => "root",     //数据库密码

        'dbname' => "undefined",    // 数据库名称

        'charset' => "utf8" ,       // 编码集

        'initConnectCount'=> 16    //初始的连接 数量
    ];


    //当前的连接池的 连接句柄 数量
    /**
     *  $connectorPool mysql连接句柄
     */
    protected static array $connectorPool =[];

    private  static int  $poolCount =0;





    public function __construct(array $config)
    {
        //合并参数
        $mergeConfig= array_merge(self::DEFAULT_CONFIG,$config);

        $dsn=$mergeConfig['driverType'].":".$mergeConfig['host']."=127.0.0.1;port=".$mergeConfig['port'].
           ";dbname=".$mergeConfig['dbname'].";charset=".$mergeConfig['charset'];

        //连接
        for ($i = 0; $i <= $mergeConfig['initConnectCount']; $i++) {
            try{

                $connector= new \PDO($dsn,$config['username'],$config['password']);

                self::$connectorPool[]=$connector;
                self::$poolCount++;
            } catch (Exception $PDOException) {
                echo $PDOException->getMessage();
            }

        }

    }

    public static function getPoolCount(){
        return self::$poolCount;
    }

    /**
     * @return mixed mysqlConnector
     */
    public static function getConnector():\PDO{
        self::$poolCount -= 1;
        return array_pop(self::$connectorPool);
    }

    /**
     * @param $connector | mysqlConnector
     */
    public static function pullConnector($connector){
        self::$poolCount += 1;
        array_push(self::$connectorPool,$connector);
    }



}
