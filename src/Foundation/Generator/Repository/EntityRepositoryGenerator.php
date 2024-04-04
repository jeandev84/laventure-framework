<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Repository;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Database\ORM\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Repository\Exception\EntityRepositoryGeneratorException;
use ReflectionException;

/**
 * EntityRepositoryGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Entity
 */
class EntityRepositoryGenerator extends ClassGenerator implements EntityRepositoryGeneratorInterface
{
    /**
     * @var string
    */
    protected string $entityClass = '';




    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config
    ) {
        parent::__construct($app, $filesystem, $config);
    }




    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->trimPath($this->config['database.orm.mapper.repository.dir']);
    }




    /**
     * @inheritDoc
    */
    public function getNamespace(): string
    {
        return $this->config['database.orm.mapper.repository.prefix'];
    }





    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return __DIR__.'/stub/repository.stub';
    }




    /**
     * @inheritDoc
     * @throws ReflectionException
    */
    public function getContent(): string
    {
        return $this->generateStub([
            "DummyNamespace"        => $this->getNamespace(),
            "DummyFullEntityName"   => $this->getClassFullName(),
            "DummyEntity"           => $this->getEntityShortName(),
            "DummyEntityRepository" => $this->getClassName(),
            "DummyAlias"            => $this->getEntity()->getTableAlias()
        ]);
    }





    /**
     * @return string
    */
    public function getClassName(): string
    {
        return sprintf('%sRepository', parent::getClassName());
    }




    /**
     * @inheritDoc
    */
    public function withEntity(string $entityClass): static
    {
        $this->entityClass = $entityClass;

        return $this;
    }




    /**
     * @return ClassMetadata
     * @throws ReflectionException
    */
    public function getEntity(): ClassMetadataInterface
    {
        return new ClassMetadata($this->entityClass);
    }





    /**
     * @return string
     * @throws EntityRepositoryGeneratorException
     * @throws ReflectionException
    */
    public function getEntityShortName(): string
    {
        $classname =  $this->getEntity()->getShortName();

        if (!$classname) {
            throw new EntityRepositoryGeneratorException(
                "Empty full class name from ". get_called_class()
            );
        }

        return $classname;
    }


    /**
     * @inheritDoc
     * @throws ReflectionException
     * @throws EntityRepositoryGeneratorException
     */
    public function getClassFullName(): string
    {
        $classname = $this->getEntity()->getName();

        if (!$classname) {
            throw new EntityRepositoryGeneratorException(
                "Empty full class name from ". get_called_class()
            );
        }

        return $classname;
    }
}
