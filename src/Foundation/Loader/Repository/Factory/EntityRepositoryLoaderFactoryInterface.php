<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\Repository\Factory;


use Laventure\Foundation\Loader\Repository\EntityRepositoryLoaderInterface;

/**
 * EntityRepositoryLoaderFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Repository\Factory
 */
interface EntityRepositoryLoaderFactoryInterface
{
       /**
        * @return EntityRepositoryLoaderInterface
       */
       public function create(): EntityRepositoryLoaderInterface;
}