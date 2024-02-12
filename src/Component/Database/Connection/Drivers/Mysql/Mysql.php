<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Mysql;

use Laventure\Component\Database\DatabaseInterface;

/**
 * Mysql
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Connection\Drivers\Mysql
*/
abstract class Mysql implements MysqlConnectionInterface
{
     /**
      * @inheritdoc
     */
     public function getName(): string
     {
         return 'mysql';
     }


     /**
      * @inheritdoc
     */
     public function getDatabase(): DatabaseInterface
     {
         return new MysqlDatabase($this, $this->getName());
     }
}