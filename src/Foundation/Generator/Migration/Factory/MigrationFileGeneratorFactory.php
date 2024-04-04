<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration\Factory;

use Laventure\Foundation\Database\Manager\ManagerInterface;
use Laventure\Foundation\Database\ORM\Enum\OrmType;
use Laventure\Foundation\Generator\Migration\Exception\MigrationGeneratorException;
use Laventure\Foundation\Generator\Migration\Persistence\PersistenceMigrationGenerator;
use Laventure\Foundation\Generator\Migration\MigrationFileGeneratorInterface;
use Laventure\Foundation\Generator\Migration\Model\ModelMigrationGenerator;
use Psr\Container\ContainerExceptionInterface;
use Psr\Container\ContainerInterface;
use Psr\Container\NotFoundExceptionInterface;

/**
 * MigrationFileGeneratorFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Migration\Factory
 */
class MigrationFileGeneratorFactory implements MigrationFileGeneratorFactoryInterface
{
    /**
     * @var array
    */
    protected array $generators = [];


    /**
     * @param ContainerInterface $app
     * @param ManagerInterface $manager
    */
    public function __construct(
        protected ContainerInterface $app,
        protected ManagerInterface $manager
    ) {
    }




    /**
     * @inheritDoc
    */
    public function createGenerator(
        string $tableName,
        string $type = null
    ): MigrationFileGeneratorInterface
    {
        $type = $type ?: $this->getCurrentOrm();

        if (isset($this->generators[$type])) {
            return $this->generators[$type];
        }

        if(!$generator = $this->generator($type)) {
            new MigrationGeneratorException("Unavailable migration generator type ($type)");
        }

        if ($this->manager->table($tableName)->exists()) {
            $generator->withUpdateStub(true);
        };

        $generator->withTableName($tableName);

        return $this->generators[$type] = $generator;
    }





    /**
     * @return string
    */
    private function getCurrentOrm(): string
    {
        return $this->manager->config()
                             ->orm()
                             ->current();
    }




    /**
     * @param $type
     * @return MigrationFileGeneratorInterface|null
     * @throws ContainerExceptionInterface
     * @throws NotFoundExceptionInterface
     */
    private function generator($type): ?MigrationFileGeneratorInterface
    {
        return [
            OrmType::Persistence => $this->app->get(PersistenceMigrationGenerator::class),
            OrmType::Model => $this->app->get(ModelMigrationGenerator::class)
        ][$type] ?? null;
    }
}
