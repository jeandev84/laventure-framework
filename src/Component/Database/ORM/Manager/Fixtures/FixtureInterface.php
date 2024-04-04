<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Fixtures;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;

/**
 * FixtureInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Fixtures
 */
interface FixtureInterface
{
    /**
     * @param EntityManagerInterface $em
     * @return void
    */
    public function load(EntityManagerInterface $em): void;
}
