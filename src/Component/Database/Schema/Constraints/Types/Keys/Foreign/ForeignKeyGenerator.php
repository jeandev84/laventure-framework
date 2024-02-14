<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign;

/**
 * ForeignKeyGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign
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
    )
    {
    }





    /**
     * @return string
    */
    public function generate(): string
    {
        $key  = md5("{$this->table}_{$this->column}");

        return sprintf('fk_%s', substr($key, 0, 12));
    }
}