<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Migration\Factory;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Foundation\Database\ORM\Enum\OrmType;
use Laventure\Foundation\Database\ORM\OrmCurrentNameDetector;
use Laventure\Foundation\Generator\Migration\Model\ModelMigrationGenerator;
use Laventure\Foundation\Generator\Migration\Exception\MigrationGeneratorException;
use Laventure\Foundation\Generator\Migration\MigrationFileGeneratorInterface;
use Laventure\Foundation\Generator\Migration\Mapper\MapperMigrationGenerator;
use Psr\Container\ContainerInterface;

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
     * @param OrmCurrentNameDetector $ormCurrentNameDetector
    */
    public function __construct(
        protected ContainerInterface $app,
        protected OrmCurrentNameDetector $ormCurrentNameDetector
    )
    {
    }



    /**
     * @inheritDoc
    */
    public function createGenerator(string $type): MigrationFileGeneratorInterface
    {
          if (isset($this->generators[$type])) {
              return $this->generators[$type];
          }

          return $this->generators[$type] = match($type) {
              OrmType::Mapper => $this->app->get(MapperMigrationGenerator::class),
              OrmType::Model => $this->app->get(ModelMigrationGenerator::class),
              default => new MigrationGeneratorException("Unavailable migration generator type ($type)")
          };
    }





    /**
     * @param string|null $type
     * @return MigrationFileGeneratorInterface
    */
    public function create(string $type = null): MigrationFileGeneratorInterface
    {
        return $this->createGenerator($type ?: $this->getDefaultType());
    }





    /**
     * @return string
    */
    private function getDefaultType(): string
    {
        return $this->ormCurrentNameDetector->getTypeName();
    }
}