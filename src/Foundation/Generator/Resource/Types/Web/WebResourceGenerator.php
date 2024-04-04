<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Types\Web;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\WebResource;
use Laventure\Foundation\Generator\Resource\Exception\ResourceGeneratorException;
use Laventure\Foundation\Generator\Resource\ResourceGenerator;

/**
 * WebResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource\Web
*/
class WebResourceGenerator extends ResourceGenerator implements WebResourceGeneratorInterface
{
    /**
     * @inheritDoc
     * @throws ResourceGeneratorException
    */
    public function getResource(): Resource
    {
        return new WebResource(
            $this->getResourceName(),
            $this->getControllerName()
        );
    }







    /**
     * @inheritDoc
    */
    public function generateTemplates(): bool
    {
        return false;
    }



    /**
     * @return string
    */
    public function getMethodStubPath(): string
    {
        return __DIR__.'/stub/action.stub';
    }
}
