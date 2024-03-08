<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Resolver;

use DateTimeInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field\ClassFieldInterface;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldType;
use Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Types\ClassFieldTypeInterface;
use Laventure\Contract\Resolver\ResolverInterface;

/**
 * AttributeValueResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Resolver
*/
class AttributeValueResolver implements ResolverInterface
{
     /**
      * @var ClassFieldType
     */
     protected ClassFieldType $type;



     /**
      * @param ClassFieldTypeInterface $type
     */
     public function __construct(ClassFieldTypeInterface $type)
     {
         $this->type = $type;
     }



     /**
      * @return mixed
     */
     public function getValue(): mixed
     {
         return $this->type->getValue();
     }



     /**
      * @return DateTimeInterface
     */
     public function getDatetime(): DateTimeInterface
     {
         return $this->getValue();
     }




     /**
      * @inheritDoc
     */
     public function resolve(): mixed
     {
         if ($this->type->isDatetime()) {
             return $this->getDatetime()->format('Y-m-d H:i:s');
         }

         return $this->getValue();
     }
}