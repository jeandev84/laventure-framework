<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Relationship;


/**
 * RelationshipInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\RelationshipAttribute
 */
interface RelationshipInterface
{


    /**
     * @param $field
     * @return bool
    */
    public function hasAssociatedField($field): bool;




    /**
     * @param $field
     * @return AssociatedAttribute
    */
    public function getAssociate($field): AssociatedAttribute;




    /**
     * @return AssociatedAttribute[]
    */
    public function getTypes(): array;





    /**
     * @return array
    */
    public function toArray(): array;
}