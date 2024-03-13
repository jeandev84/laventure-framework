<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Api;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Component\Routing\Route\Route;
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
     * @inheritDoc
    */
    public function getResource(): Resource
    {
        return new ApiResource(
            $this->getResourceName(),
            $this->getClassName()
        );
    }





    /**
     * @inheritDoc
    */
    public function generateStubMethods(): string
    {
        $methodStubs = [];

        foreach ($this->getResource()->getRoutes() as $route) {
            $methodStubs[] = $route;
        }

        dd($methodStubs);
    }




    /**
     * @return string
    */
    public function getMethodStubPath(): string
    {
        return __DIR__.'/stub/action.stub';
    }




    /**
     * @param Route $route
     * @return string
    */
    public function generateStubMethod(Route $route): string
    {
         return $this->generateStub([

         ]);
    }
}
