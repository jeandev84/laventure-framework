<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Factory;


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
       public function getAllMetadata();
       public function getMetadataFor($classname);
       public function hasMetadataFor($classname);
       public function setMetadataFor($classname, $class);
       public function isTransient($classname);
}