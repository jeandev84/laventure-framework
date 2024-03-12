<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource\Web;

use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\WebResource;
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
    */
    public function getResource(): Resource
    {
        return new WebResource('books', $this->getClassName());
    }




    /**
     * @inheritDoc
    */
    public function generateTemplates(): bool
    {

    }




    /**
     * @inheritDoc
    */
    public function generateController(): bool
    {

    }
}
