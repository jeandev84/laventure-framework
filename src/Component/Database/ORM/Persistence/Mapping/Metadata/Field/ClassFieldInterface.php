<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field;

/**
 * ClassFieldInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Mapper\Mapping\Metadata\Field
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
     * Returns property value
     *
     * @return mixed
    */
    public function getValue(): mixed;





    /**
     * Returns attribute name for persistence to the database
     *
     * @return string
    */
    public function getAttribute(): string;
}
