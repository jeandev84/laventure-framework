<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Resolver\Column\Value;

use DateTimeInterface;
use Laventure\Component\Database\ORM\Mapping\Field\Types\ClassFieldTypeInterface;

/**
 * ColumnValueResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Field
*/
class ColumnValueResolver implements ColumnValueResolverInterface
{

    /**
     * @param ClassFieldTypeInterface $type
    */
    public function __construct(
        protected ClassFieldTypeInterface $type
    )
    {

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
        } elseif ($this->type->isBoolean()) {
            return intval($this->getValue());
        }

        return $this->getValue();
    }
}