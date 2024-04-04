<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\Database;

use Laventure\Component\Database\Configuration\Configuration;
use Laventure\Foundation\Database\Manager\Manager;
use PDO;

/**
 * TestManager
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Database
 */
class TestManager
{
    private static $instance;


    private static $config = [
        'driver'     => 'mysql',
        'host'       => '127.0.0.1',
        'port'       => 3306,
        'database'   => 'laventure_test',
        'charset'    => 'utf8',
        'username'   => 'root',
        'password'   => 'secret',
        'options' => [
            #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
            PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
        ]
    ];





    /**
     * @param null $connection
     * @return Manager
    */
    public static function make($connection = null): Manager
    {
        if (! static::$instance) {
            $manager = new Manager();
            $manager->open($connection ?: 'mysql', new Configuration(self::$config));
            static::$instance = $manager;
        }

        return static::$instance;
    }
}
