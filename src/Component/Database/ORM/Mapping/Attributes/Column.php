<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Attributes;

use Attribute;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;

/**
 * Column
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Attributes
 */
#[Attribute(
    Attribute::TARGET_PROPERTY
)]
class Column
{

    /**
     * @var ColumnType|string
    */
    public ColumnType|string $type;





    /**
     * @param string|null $name
     * @param int|null $length
     * @param bool|null $nullable
     * @param ColumnType|string|null $type
     * @param array $options
    */
    public function __construct(
        public ?string $name = null,
        public ?int $length = null,
        public ?bool $nullable = false,
        ColumnType|string $type = null,
        public array $options = []
    ) {
         if ($type instanceof ColumnType) {
             $type = $type->value;
         }

         $this->type = $type ?: ColumnType::STRING->value;
    }





    /**
     * @return bool
    */
    public function hasLength(): bool
    {
        return $this->length > 0;
    }




    /**
     * @return mixed
    */
    public function default(): mixed
    {
        return $this->option('default');
    }





    /**
     * @param $name
     * @return mixed
    */
    public function option($name): mixed
    {
        return $this->options[$name] ?? null;
    }
}
