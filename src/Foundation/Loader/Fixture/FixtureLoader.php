<?php
declare(strict_types=1);

namespace Laventure\Foundation\Loader\Fixture;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Container;
use Laventure\Component\Database\ORM\Manager\Fixtures\Fixture;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Foundation\Loader\FilesDirectory\FilesDirectoryLoader;


/**
 * FixtureLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Loader\Fixture
 */
class FixtureLoader extends FilesDirectoryLoader implements FixtureLoaderInterface
{

    const PREFIX = 'database.orm.persistence.';


    /**
     * @var array
    */
    protected array $fixtures = [];




    /**
     * @param Container $app
     * @param Filesystem $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        protected Container $app,
        Filesystem $filesystem,
        ConfigInterface $config
    )
    {
        parent::__construct($filesystem, $config);
    }






    /**
     * @inheritDoc
    */
    public function getPrefix(): string
    {
        return $this->config[self::PREFIX . 'fixtures.prefix'];
    }




    /**
     * @inheritDoc
    */
    public function getDirectory(): string
    {
        return $this->config[self::PREFIX . 'fixtures.dir'];
    }




    /**
     * @inheritDoc
    */
    public function loadFixtures(): array
    {
        foreach ($this->load() as $classname) {
            $this->loadFixture($this->app->get($classname));
        }

        return $this->fixtures;
    }






    /**
     * @param Fixture $fixture
     * @return Fixture
    */
    public function loadFixture(Fixture $fixture): Fixture
    {
        return $this->fixtures[] = $fixture;
    }
}