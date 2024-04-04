<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Factory;

use Laventure\Component\Database\ORM\Mapping\ClassMetadata;
use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;
use RuntimeException;

/**
 * ClassMetadataFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Metadata\Factory
*/
class ClassMetadataFactory implements ClassMetadataFactoryInterface
{
    /**
     * @var ClassMetadataInterface[]
    */
    protected array $metadata = [];





    /**
     * @param array $collections
    */
    public function __construct(array $collections = [])
    {
        $this->addClassMetadataCollection($collections);
    }




    /**
     * @param ClassMetadataInterface $metadata
     * @return $this
    */
    public function addMetadata(ClassMetadataInterface $metadata): static
    {
        $this->metadata[$metadata->getName()] = $metadata;

        return $this;
    }






    /**
     * @param ClassMetadataInterface[] $collections
     * @return $this
    */
    public function addClassMetadataCollection(array $collections): static
    {
        foreach ($collections as $metadata) {
            $this->addMetadata($metadata);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getAllMetadata(): array
    {
        return $this->metadata;
    }




    /**
     * @inheritDoc
    */
    public function getMetadataFor($classname): ClassMetadataInterface
    {
        return new ClassMetadata($classname);
    }




    /**
     * @inheritDoc
    */
    public function hasMetadataFor($classname): bool
    {
        return isset($this->metadata[$classname]);
    }






    /**
     * @inheritDoc
    */
    public function setMetadataFor($classname, $class): static
    {
        $this->metadata[$classname] = $this->getMetadataFor($class);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function isTransient($classname): bool
    {
        throw new RuntimeException(__METHOD__ . ' not already implemented.');
    }
}
