<?php declare(strict_types=1);

namespace app;


class AutoConfig{

    public function __construct(string $rootPath)
    {
        $dbConfig=parse_ini_file( $rootPath.'/config/databases.ini');
        var_dump($dbConfig);
    }





}
