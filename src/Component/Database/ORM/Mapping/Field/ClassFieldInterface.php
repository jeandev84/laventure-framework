<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Field;

use Laventure\Component\Database\ORM\Mapping\Field\Types\ClassFieldTypeInterface;

/**
 * ClassFieldInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Metadata\Field
*/
interface ClassFieldInterface
{
    /**
     * Returns property name
     *
     * @return string
    */
    public function getName(): string;




    /**
     * @param $value
     * @return $this
    */
    public function setValue($value): static;




    /**
     * Returns property value
     *
     * @return mixed
    */
    public function getValue(): mixed;






    /**
     * @return ClassFieldTypeInterface
    */
    public function getType(): ClassFieldTypeInterface;









    /**
     * @return mixed
    */
    public function getColumnValue(): mixed;
}
