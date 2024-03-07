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
 * @package  Laventure\Component\Database\ORM\Persistence\Mapping\Metadata\Field
 */
interface ClassFieldInterface
{
    /**
     * @return string
    */
    public function getFieldName(): string;




    /**
     * @return mixed
    */
    public function getFieldValue(): mixed;




    /**
     * @return string
    */
    public function getAttributeName(): string;
}
