<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Update\Null;

use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilder;
use Laventure\Component\Database\Query\Null\NullQuery;
use Laventure\Component\Database\Query\QueryInterface;

/**
 * NullUpdateBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Builder\SQL\DML\PgsqlUpdateBuilder
*/
class NullUpdateBuilder extends UpdateBuilder
{
    /**
     * @return string
    */
    public function getSQL(): string
    {
        return '';
    }




    /**
     * @return QueryInterface
    */
    public function getQuery(): QueryInterface
    {
        return new NullQuery();
    }
}
