<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection;


/**
 * ConnectionStackInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection
*/
interface ConnectionStackInterface
{
     /**
      * @return ConnectionInterface[]
     */
     public function getConnections(): array;
}