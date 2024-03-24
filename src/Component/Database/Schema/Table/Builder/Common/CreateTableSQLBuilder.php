<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Builder\Common;

use Laventure\Component\Database\Schema\Table\Builder\Contract\CreateTableSQLBuilderInterface;

/**
 * CreateTableSQLBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Builder\Common
*/
class CreateTableSQLBuilder implements CreateTableSQLBuilderInterface
{
    /**
     * @inheritDoc
    */
    public function create($table): static
    {

    }




    /**
     * @inheritDoc
    */
    public function criteria(array $criteria): static
    {

    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {

    }
}
