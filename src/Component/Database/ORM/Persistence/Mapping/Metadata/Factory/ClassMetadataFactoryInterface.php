<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory;


use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\ClassMetadataInterface;

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
        * @param string $classname
        * @return ClassMetadataInterface
       */
       public function getMetadataFor(string $classname): ClassMetadataInterface;





       /**
        * Determine if  exists metadata for given class name
        *
        * @param string $classname
        * @return bool
       */
       public function hasMetadataFor(string $classname): bool;





       /**
        * Add class metadata to storage
        *
        * @param string $classname
        * @param $class
        * @return mixed
       */
       public function setMetadataFor(string $classname, $class): mixed;





       /**
        * Determine if is transient given classname
        *
        * @param string $classname
        * @return bool
       */
       public function isTransient(string $classname): bool;
}