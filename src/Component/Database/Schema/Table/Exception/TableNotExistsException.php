<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Exception;

/**
 * TableNotExistsException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Exception
*/
class TableNotExistsException extends TableException
{
    /**
     * @param string $table
     * @param array $data
    */
    public function __construct(string $table, array $data = [])
    {
        parent::__construct("Table '$table' not exists.", $data, 404);
    }
}
