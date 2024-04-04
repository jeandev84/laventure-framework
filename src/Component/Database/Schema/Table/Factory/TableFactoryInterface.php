<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table\Factory;

use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * TableFactoryInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Factory
 */
interface TableFactoryInterface
{
    /**
     * @param string $name
     * @param string $schemaName
     * @return TableInterface
    */
    public function createTable(
        string $name,
        string $schemaName = ''
    ): TableInterface;
}
