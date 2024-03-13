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
     * @param string $resource
     * @return $this
    */
    public function withResource($resource): static
    {
        return parent::withResource($resource);
    }





    /**
     * @inheritDoc
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
    public function getResourceName(): string
    {
        return strtolower($this->getClassName());
    }
}
