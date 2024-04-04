<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Fixtures;

use Laventure\Contract\Loader\LoaderInterface;

/**
 * FixtureManagerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Fixtures
 */
interface FixtureManagerInterface extends LoaderInterface
{

    /**
     * @param FixtureInterface[] $fixtures
     * @return $this
    */
    public function addFixtures(array $fixtures): static;




    /**
     * Returns all fixtures
     *
     * @return FixtureInterface[]
    */
    public function getFixtures(): array;
}
