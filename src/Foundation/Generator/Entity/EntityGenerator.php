<?php
declare(strict_types=1);

namespace Laventure\Foundation\Generator\Entity;

use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Filesystem\FilesystemInterface;
use Laventure\Foundation\Application;
use Laventure\Foundation\Generator\Class\ClassGenerator;
use Laventure\Foundation\Generator\Class\Exception\ClassGeneratorException;
use Laventure\Foundation\Generator\Repository\EntityRepositoryGenerator;
use Laventure\Foundation\Generator\Repository\EntityRepositoryGeneratorInterface;
use ReflectionException;

/**
 * EntityGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Entity
*/
class EntityGenerator extends ClassGenerator implements EntityGeneratorInterface
{


    /**
     * @param Application $app
     * @param FilesystemInterface $filesystem
     * @param ConfigInterface $config
     * @param EntityRepositoryGenerator $entityRepositoryGenerator
    */
    public function __construct(
        Application $app,
        FilesystemInterface $filesystem,
        ConfigInterface $config,
        protected EntityRepositoryGenerator $entityRepositoryGenerator
    )
    {
        parent::__construct($app, $filesystem, $config);
    }




    /**
     * @param string $classname
     * @return $this
    */
    public function withClassName(string $classname): static
    {
        $this->entityRepositoryGenerator->withClassName($classname);

        return parent::withClassName($classname);
    }




    /**
     * @inheritDoc
    */
    public function getBaseDir(): string
    {
        return $this->trimPath(
            $this->config['database.orm.mapper.entity.dir']
        );
    }




    /**
     * @inheritDoc
    */
    public function getBaseNamespace(): string
    {
        return $this->config['database.orm.mapper.entity.prefix'];
    }




    /**
     * @inheritDoc
    */
    public function generateRepository(): bool
    {
        return $this->entityRepositoryGenerator->generate();
    }





    /**
     * @inheritDoc
    */
    public function getStubPath(): string
    {
        return __DIR__.'/stub/entity.stub';
    }




    /**
     * @inheritDoc
    */
    public function getContent(): string
    {
        return $this->generateStub([
            "DummyNamespace" => $this->getNamespace(),
            "DummyClassName" => $this->getClassName(),
            #"DummyActions"   => $this->generateStubMethods()
        ]);
    }




    /**
     * @return string
    */
    public function getEntityFullName(): string
    {
        $classname = $this->getClassName();

        return sprintf("%s\\%s", $this->getNamespace(), $classname);
    }




    /**
     * @return bool
    */
    public function generate(): bool
    {
        if(parent::generate()) {
            $repo = $this->entityRepositoryGenerator
                         ->withEntity($this->getEntityFullName());

            dd($repo->getContent());
        }

        dd('NO');

        /*
        $repo = $this->entityRepositoryGenerator
                     ->withEntity($this->getEntityFullName());

        dd($repo->getContent());

        // Generate entity
        if(parent::generate()) {
            $this->entityRepositoryGenerator
                ->withEntity($this->getEntityFullName())
                ->generate();
        }

        return $this->generated() && $this->generateRepository();
        */
    }




    /**
     * @return bool
    */
    public function hasRepository(): bool
    {
        return $this->entityRepositoryGenerator->generated();
    }




    /**
     * @inheritDoc
    */
    public function getRepositoryPath(): string
    {
        return $this->entityRepositoryGenerator->getTargetPath();
    }




    /**
     * @inheritDoc
    */
    public function getEntityRepositoryGenerator(): EntityRepositoryGeneratorInterface
    {
        return $this->entityRepositoryGenerator;
    }
}