<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;


use Laventure\Component\Routing\Route\Resource\Resource;
use Laventure\Foundation\Generator\Controller\ControllerGenerator;

/**
 * ResourceControllerGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
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