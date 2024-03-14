<?php

declare(strict_types=1);

namespace Laventure\Component\Routing\Route\Resource\Null;

use Laventure\Component\Routing\Route\Collector\RouteCollectorInterface;
use Laventure\Component\Routing\Route\Resource\Contract\ResourceInterface;
use Laventure\Component\Routing\Route\Resource\Exception\ResourceException;

/**
 * NullResource
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Routing\Route\Resource\Null
*/
class NullResource implements ResourceInterface
{
    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        throw new ResourceException("Could not get name from ". get_called_class());
    }



    /**
     * @inheritDoc
     */
    public function getController(): string
    {
        throw new ResourceException("Could not get controller from ". get_called_class());
    }

    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        throw new ResourceException("Could not get type from ". get_called_class());
    }

    /**
     * @inheritDoc
     */
    public function getPrefix(): string
    {
        throw new ResourceException("Could not get prefix from ". get_called_class());
    }



    /**
     * @inheritDoc
    */
    public function map(RouteCollectorInterface $collector): RouteCollectorInterface
    {
        throw new ResourceException("Could not map routes from ". get_called_class());
    }



    /**
     * @inheritDoc
    */
    public function getRoutes(): array
    {
        throw new ResourceException("Could not get routes from ". get_called_class());
    }

    /**
     * @inheritDoc
     */
    public function toArray(): array
    {
        throw new ResourceException("Could not transform to array from ". get_called_class());
    }
}
