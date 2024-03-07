<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DML;

use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\PdoSQLBuilderTrait;
use Laventure\Component\Database\Query\Builder\SQL\DML\Update\UpdateBuilderDecorator;

/**
 * PgsqlUpdateBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\PdoConnection\Extensions\PDO\Query\Builder\SQL\Commands\DML
*/
class PdoUpdateBuilder extends UpdateBuilderDecorator
{
    use PdoSQLBuilderTrait;
}
