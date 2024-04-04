<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Factory;

use Laventure\Component\Database\ORM\Manager\Config\Configuration;
use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;

/**
 * EntityManagerFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Factory
 */
interface EntityManagerFactoryInterface
{
    /**
     * @param Configuration $config
     * @return EntityManagerInterface
    */
    public function createEntityManager(
        Configuration $config
    ): EntityManagerInterface;
}
