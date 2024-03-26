<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Foreign;

/**
 * ForeignKeyGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers\Keys\Foreign
*/
class ForeignKeyGenerator
{
    /**
     * @param string $table
     * @param string $column
    */
    public function __construct(
        protected string $table,
        protected string $column
    ) {
    }




    /**
     * @param bool $hash
     * @return string
    */
    public function generate(bool $hash = false): string
    {
        $key  = "{$this->table}_{$this->column}";

        if ($hash === true) {
            $key  = md5("{$this->table}_{$this->column}");
            $key  = substr($key, 0, 12);
        }

        return sprintf('fk_%s', $key);
    }
}
