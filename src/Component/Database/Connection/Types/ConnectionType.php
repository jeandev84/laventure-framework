<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Types;

/**
 * ConnectionType
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Types
*/
enum ConnectionType
{
   const Mysql  = 'mysql';
   const Pgsql  = 'pgsql';
   const Oracle = 'oci';
   const Sqlite = 'sqlite';
}