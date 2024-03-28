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
     * @var array
    */
    protected $timestamps = [];




    /**
     * @return string[]
    */
    public function getTimestamps(): array
    {

        if (empty($this->timestamps)) {
           $this->timestamps = [
               TimestampColumn::createdAt(),
               TimestampColumn::updatedAt()
           ];
        }

        $timestamps = [];

        foreach ($this->timestamps as $column) {
            $timestamps[$column] = date('Y-m-d H:i:s');
        }

        return $timestamps;
    }




    /**
     * @param array $attributes
     * @return array
    */
    public function mergeTimestamps(array $attributes): array
    {
        return array_merge($attributes, $this->getTimestamps());
    }
}