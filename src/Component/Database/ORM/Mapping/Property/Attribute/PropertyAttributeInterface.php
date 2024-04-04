<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Property\Attribute;


/**
 * PropertyAttributeInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Property
*/
interface PropertyAttributeInterface
{

     /**
      * @return string
     */
     public function getPropertyName(): string;




     /**
      * @return mixed
     */
     public function getAttribute(): mixed;

}