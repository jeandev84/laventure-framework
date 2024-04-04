<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Manager\Fixtures;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;

/**
 * FixtureManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Manager\Fixtures
*/
class FixtureManager implements FixtureManagerInterface
{
    /**
     * Store fixtures
     *
     * @var FixtureInterface[]
    */
    protected $fixtures = [];



    /**
     * @var array
    */
    protected array $loaded = [];


    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(protected EntityManagerInterface $em)
    {
    }





    /**
     * @param FixtureInterface $fixture
     * @return $this
    */
    public function addFixture(FixtureInterface $fixture): static
    {
        $this->fixtures[] = $fixture;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addFixtures(array $fixtures): static
    {
        foreach ($fixtures as $fixture) {
            $this->addFixture($fixture);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getFixtures(): array
    {
        return $this->fixtures;
    }





    /**
     * @inheritDoc
    */
    public function load(): array
    {
        foreach ($this->fixtures as $fixture) {
            $fixture->load($this->em);
            $this->loaded[] = get_class($fixture);
        }

        return $this->loaded;
    }
}
