<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Repository;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadata;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use ReflectionClass;
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
    )
    {
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
    public function getBaseNamespace(): string
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
        # "DummyEntityClass" => $this->getClassName() or $this->getEntityShortName();
        return $this->generateStub([
            "DummyNamespace"      => $this->getNamespace(),
            "DummyFullEntityName" => $this->getEntityFullName(),
            "DummyEntity"         => $this->getEntityShortName(),
            "DummyEntityAlias"    => "u"
        ]);
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
     * @throws ReflectionException
    */
    public function getEntityShortName(): string
    {
        return $this->getEntity()->getName();
    }




    /**
     * @throws ReflectionException
    */
    public function getEntityFullName(): string
    {
        return $this->getEntity()->getName();
    }
}