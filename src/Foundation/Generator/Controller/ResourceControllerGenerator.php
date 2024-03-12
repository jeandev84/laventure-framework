<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Controller;


use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Component\Routing\Route\Resource\Types\ApiResource;

/**
 * ResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Controller\Web
*/
abstract class ResourceControllerGenerator extends ControllerGenerator
{
    /**
     * @param Resource $resource
     * @return $this
    */
    public function withResource(Resource $resource): static
    {
        return $this->withController(
            $resource->getController(),
            $resource->getInfo()->getMethods()
        );
    }
}