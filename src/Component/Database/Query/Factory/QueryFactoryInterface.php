<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Factory;

use Laventure\Component\Database\Query\QueryInterface;

/**
 * QueryFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Factory
*/
interface QueryFactoryInterface
{
    /**
     * @return QueryInterface
    */
    public function createQuery(): QueryInterface;
}
