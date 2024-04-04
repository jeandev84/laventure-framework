<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Service;

use Laventure\Component\Database\ORM\Mapping\Factory\ClassMetadataFactoryInterface;
use ReflectionClass;
use ReflectionException;

/**
 * ReflectionService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Service
*/
class ReflectionService implements ReflectionServiceInterface
{
    /**
     * @param ClassMetadataFactoryInterface $metadataFactory
    */
    public function __construct(
        protected ClassMetadataFactoryInterface $metadataFactory
    ) {
    }





    /**
     * @param $class
     * @return ReflectionClass
    */
    public function getReflectionClass($class): ReflectionClass
    {
        return $this->metadataFactory
                    ->getMetadataFor($class)
                    ->getReflectionClass();
    }




    /**
     * @inheritDoc
    */
    public function getParentClasses($class)
    {
        return $this->getReflectionClass($class)
                    ->getParentClass();
    }



    /**
     * @inheritDoc
    */
    public function getClassShortName($class)
    {
        return $this->getReflectionClass($class)
                    ->getShortName();
    }




    /**
     * @inheritDoc
    */
    public function getClassNamespace($class)
    {
        return $this->getReflectionClass($class)
                    ->getNamespaceName();
    }



    /**
     * @inheritDoc
    */
    public function getClass($class)
    {
        return $this->getReflectionClass($class)
                    ->getName();
    }




    /**
     * @inheritDoc
     * @throws ReflectionException
    */
    public function getAccessibleProperty($class, $property)
    {
        return $this->getReflectionClass($class)
                    ->getProperty($property);
    }




    /**
     * @inheritDoc
    */
    public function hasPublicMethod($class, $method)
    {
        return $this->getReflectionClass($class)
                    ->hasMethod($method);
    }




    /**
     * @inheritDoc
    */
    public function call(callable $callback, array $arguments): mixed
    {
        return call_user_func_array($callback, $arguments);
    }
}
