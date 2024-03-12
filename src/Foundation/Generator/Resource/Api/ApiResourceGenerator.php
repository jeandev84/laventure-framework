<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Api;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Foundation\Generator\Resource\ResourceGenerator;

/**
 * ApiResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Api
*/
class ApiResourceGenerator extends ResourceGenerator
{
    /**
     * @var string
    */
    protected string $modulePrefix = 'Api';




    /**
     * @param string $resource
     * @return $this
    */
    public function withResource(string $resource): static
    {
        return parent::withResource($this->resolveResource($resource));
    }





    /**
     * @inheritDoc
    */
    public function getResource(): Resource
    {
        $resourceName   = $this->getResourceName();
        $controllerName = $this->controllerGenerator->generateControllerName();

        return new ApiResource($resourceName, $controllerName);
    }





    /**
     * @return string
    */
    public function getResourceName(): string
    {
        return strtolower($this->getClassName());
    }






    /**
     * @param $resource
     * @return string
    */
    private function resolveResource($resource): string
    {
        return $this->modulePrefix . "/". trim($resource, "\\/");
    }
}
