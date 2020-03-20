<?php declare(strict_types=1);

namespace app;


class AutoConfig{

    private array $configs=[
        'dbConfig'=>null,
        'cacheConfig'=>null,
    ];

    public function __construct(string $rootPath) {
        $dbConfig=parse_ini_file( $rootPath.'/config/databases.ini');
        $this->setConfigs([
            'dbConfig' =>$dbConfig,
        ]);
    }

    /**
     * @return array
     */
    public function getConfigs():array {
        return $this->configs;
    }

    /**
     * @param array $configs
     */
    private function setConfigs(array $configs):void{
        $this->configs =$configs;
    }
}
