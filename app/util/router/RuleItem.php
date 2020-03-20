<?php declare(strict_types=1);

namespace app\util\router;



class RuleItem {

    public  function __construct(string $uri)
    {
        $this->name=$uri;
        //
        list($controller, $action) = explode('/', trim($uri, '/'));
        $this->controller=$controller;
        $this->action=$action;
    }
    private string $controller ;
    
    private string $action ;
    
    private string $name;

    private  array $methods;

    private string $path;

    private array $Params;

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void
    {
        $this->name = $name;
    }

    /**
     * @return array
     */
    public function getMethods(): array
    {
        return $this->methods;
    }

    /**
     * @param array $methods
     */
    public function setMethods(array $methods): void
    {
        $this->methods = $methods;
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        return $this->path;
    }

    /**
     * @param string $path
     */
    public function setPath(string $path): void
    {
        $this->path = $path;
    }

    /**
     * @return array
     */
    public function getParams(): array
    {
        return $this->Params;
    }

    /**
     * @param array $Params
     */
    public function setParams(array $Params): void
    {
        $this->Params = $Params;
    }



}
