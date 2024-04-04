<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Field;


use Laventure\Contract\Mapping\MappingInterface;

/**
 * ClassFieldMappingInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Field\Contract
 */
interface ClassFieldMappingInterface extends MappingInterface
{
      /**
       * @return mixed
      */
      public function getSubject(): mixed;



      /**
       * @return ClassFieldInterface[]
      */
      public function map(): array;
}