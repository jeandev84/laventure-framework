<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Types\Api;

use Laventure\Component\Routing\Route\Resource\Enums\ResourceType;
use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;
use Laventure\Foundation\Generator\Resource\Exception\ResourceGeneratorException;
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
     * @throws ResourceGeneratorException
     */
    public function getResource(): Resource
    {
        return new ApiResource(
            $this->getResourceName(),
            $this->getControllerName()
        );
    }






    /**
     * @return string
    */
    public function getPrefix(): string
    {
        return ucfirst(ResourceType::API);
    }






    /**
     * @inheritDoc
    */
    public function getMethodStubPath(): string
    {
        return __DIR__.'/stub/action.stub';
    }
}
