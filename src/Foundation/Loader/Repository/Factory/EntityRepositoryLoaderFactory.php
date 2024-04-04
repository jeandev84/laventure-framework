<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\Repository\Factory;

use Laventure\Foundation\Loader\Repository\EntityRepositoryLoader;
use Laventure\Foundation\Loader\Repository\EntityRepositoryLoaderInterface;
use Psr\Container\ContainerInterface;

/**
 * EntityRepositoryLoaderFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Repository\Factory
*/
class EntityRepositoryLoaderFactory implements EntityRepositoryLoaderFactoryInterface
{

    public function __construct(
        protected ContainerInterface $container
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function create(): EntityRepositoryLoaderInterface
    {
        return $this->container->get(EntityRepositoryLoader::class);
    }
}