<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Factory;

use Laventure\Component\Database\ORM\Mapping\ClassMetadataInterface;

/**
 * ClassMetadataFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Metadata\Factory
 */
interface ClassMetadataFactoryInterface
{
    /**
     * Returns all class meta data
     *
     * @return ClassMetadataInterface[]
    */
    public function getAllMetadata(): array;





    /**
     * Returns class metadata for given class
     *
     * @param $classname
     * @return ClassMetadataInterface
    */
    public function getMetadataFor($classname): ClassMetadataInterface;





    /**
     * Determine if  exists metadata for given class name
     *
     * @param $classname
     * @return bool
    */
    public function hasMetadataFor($classname): bool;





    /**
     * Add class metadata to storage
     *
     * @param $classname
     * @param $class
     * @return mixed
    */
    public function setMetadataFor($classname, $class): mixed;





    /**
     * Determine if is transient given classname
     *
     * @param $classname
     * @return bool
    */
    public function isTransient($classname): bool;
}
