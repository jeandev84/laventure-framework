<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Manager\Fixtures;

use Laventure\Contract\Loader\LoaderInterface;

/**
 * FixtureManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Manager\Fixtures
 */
interface FixtureManagerInterface extends LoaderInterface
{
    /**
     * Returns all fixtures
     *
     * @return FixtureInterface[]
    */
    public function getFixtures(): array;
}
