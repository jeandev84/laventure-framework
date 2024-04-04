<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Resource;

use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Foundation\Generator\Class\ClassGeneratorInterface;
use Laventure\Foundation\Generator\Controller\ControllerGeneratorInterface;

/**
 * ResourceGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Resource
*/
interface ResourceGeneratorInterface extends ControllerGeneratorInterface
{
    /**
     * @param $resource
     * @return $this
    */
    public function withResource($resource): static;






    /**
     * Generate Entity
     *
     * @return bool
    */
    public function generateEntity(): bool;






    /**
     * @return ResourceInterface
    */
    public function getResource(): ResourceInterface;
}
