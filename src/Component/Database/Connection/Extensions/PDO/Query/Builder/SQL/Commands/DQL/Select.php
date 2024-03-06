<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DQL;

use Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\PdoSQLBuilderDecoratorTrait;
use Laventure\Component\Database\Query\Builder\SQL\DQL\Select\SelectBuilderDecorator;

/**
 * Select
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO\Query\Builder\SQL\Commands\DQL
*/
class Select extends SelectBuilderDecorator
{
      use PdoSQLBuilderDecoratorTrait;
}