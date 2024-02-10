<?php
declare(strict_types=1);

namespace PHPUnitTest\Component\Config;

use Laventure\Component\Config\Config;
use PHPUnit\Framework\TestCase;

/**
 * ConfigTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Config
 */
class ConfigTest extends TestCase
{
      public function testItRetrieveValue(): void
      {
           $config = new Config(require __DIR__.'/config/database.php');

           $this->assertSame('root', $config->get('connections.pdo.username'));
           $this->assertSame('secret', $config->get('connections.pdo.password'));
           $this->assertNotEmpty($config->get('connections.pdo.options'));
      }
}
