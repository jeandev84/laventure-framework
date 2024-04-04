<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Config;

use Laventure\Component\Config\Config;
use PDO;
use PHPUnit\Framework\TestCase;

/**
 * ConfigTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Common
 */
class ConfigTest extends TestCase
{
    public function testItRetrieveValue(): void
    {
        $config = new Config([
            'connections' => [
                'pdo' => [
                    'dsn' => 'mysql:host=127.0.0.1;dbname=grafikart_shopping_cart;charset=utf8',
                    'username' => 'root',
                    'password' => 'secret',
                    'options' => [
                        #PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ
                        PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES UTF8'
                    ],
                ]
            ]
        ]);

        $this->assertSame('root', $config->get('connections.pdo.username'));
        $this->assertSame('secret', $config->get('connections.pdo.password'));
        $this->assertNotEmpty($config->get('connections.pdo.options'));
    }
}
