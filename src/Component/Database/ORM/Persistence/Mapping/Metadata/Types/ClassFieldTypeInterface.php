<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types;


/**
 * FieldTypeInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata
*/
interface ClassFieldTypeInterface
{
      /**
       * @return string
      */
      public function getField(): string;



      /**
       * @return mixed
      */
      public function getValue(): mixed;




      /**
       * @return bool
      */
      public function isIdentifier(): bool;





      /**
       * Determine if associated value is instance of DatetimeInterface
       *
       * @return bool
      */
      public function isDatetime(): bool;






      /**
       * Determine if the given value is association
       *
       * @return bool
      */
      public function isAssociation(): bool;









      /**
       * Determine if associated value is instance of ObjectCollectionInterface
       *
       * @return bool
      */
      public function isCollectionAssociate(): bool;







      /**
       * @return bool
      */
      public function isSingleAssociate(): bool;








      /**
       * Determine if value of given field is null
       *
       * @return bool
      */
      public function isNull(): bool;
}