<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Identifier;


use Laventure\Component\Database\ORM\Mapping\Association\Collection\CollectionAssociationField;
use Laventure\Component\Database\ORM\Mapping\Association\Single\SingleAssociationField;
use Laventure\Component\Database\ORM\Mapping\Field\ClassFieldMappingInterface;
use Laventure\Contract\Mapping\MappingInterface;


/**
 * IdentifierFieldMapping
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Field\Types\Identifier
*/
class IdentifierFieldMapping implements MappingInterface
{

    /**
     * @param ClassFieldMappingInterface $classFieldMapping
    */
    public function __construct(
        protected ClassFieldMappingInterface $classFieldMapping
    )
    {

    }




    /**
     * @inheritDoc
    */
    public function map(): array
    {
         $identifiers = [];

         foreach ($this->classFieldMapping->map() as $field) {

             $name      = $field->getName();
             $value     = $field->getValue();
             $typeName  = $field->getType()->getName();

             if ($field->getType()->isSingleAssociate()) {
                 $identifiers[$name] = new SingleAssociationField(
                     $name,
                     $value,
                     $typeName
                 );
             } elseif ($field->getType()->isCollectionAssociate()) {
                 $identifiers[$name] = new CollectionAssociationField(
                     $name,
                     $value,
                     $typeName
                 );
             }

         }

         return $identifiers;
    }
}