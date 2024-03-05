<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Extensions\PDO;


use Laventure\Component\Database\Connection\ConnectionInterface;

/**
 * Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Extensions\PDO
*/
abstract class Connection implements ConnectionInterface, PdoConnectionInterface
{
     use PdoConnectionTrait;
}