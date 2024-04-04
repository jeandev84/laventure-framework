<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Traits;

use Laventure\Component\Database\Schema\Column\Types\TimestampColumn;

/**
 * Timestamps
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Traits
 */
trait Timestamps
{
    /**
     * @var bool
    */
    protected $timestamps = true;





    /**
     * @return bool
    */
    public function hasTimestamps(): bool
    {
        return $this->timestamps;
    }




    /**
     * Returns column name created at
     *
     * @return string
    */
    public function getCreatedAt(): string
    {
        return TimestampColumn::createdAt();
    }





    /**
     * Returns column name updated at
     *
     * @return string
    */
    public function getUpdatedAt(): string
    {
        return TimestampColumn::updatedAt();
    }




    /**
     * @return string[]
    */
    public function getTimestamps(): array
    {
        $timestamps = [];

        foreach ($this->getTimestampColumns() as $column) {
            $timestamps[$column] = date('Y-m-d H:i:s');
        }

        return $timestamps;
    }





    /**
     * @return array
    */
    private function getTimestampColumns(): array
    {
        return [
            $this->getCreatedAt(),
            $this->getUpdatedAt()
        ];
    }
}
