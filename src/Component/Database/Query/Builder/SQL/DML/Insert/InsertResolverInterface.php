<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\DML\Insert;


/**
 * InsertResolverInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Query\Builder\SQL\DML\Insert
*/
interface InsertResolverInterface
{

    /**
     * @param array $values
     * @return mixed
    */
    public function resolveMultipleInsert(array $values): mixed;





    /**
     * @param array $values
     * @return mixed
    */
    public function resolveInsert(array $values): mixed;
}