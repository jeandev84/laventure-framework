<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Service\Connection;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Manager\DatabaseManager;
use PDO;

/**
 * Connection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Connection
*/
class Connection
{

     private static $instance;


     private static $config = [
         'mysql' => [
             'dsn' => 'mysql:host=127.0.0.1;dbname=laventure_test;charset=utf8',
             'username' => 'root',
             'password' => 'secret',
             'options' => [
                 #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                 PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
             ],
         ]
     ];





     /**
      * @param string $name
      * @return ConnectionInterface
     */
     public static function make(string $name = 'mysql'): ConnectionInterface
     {
        if (! static::$instance) {
            # 1. Initialize database manager
            $manager     = new DatabaseManager();
            $manager->open($name, self::$config[$name]);

            # 2. Get connection
            static::$instance = $manager->connection();
        }

        return static::$instance;
     }
}