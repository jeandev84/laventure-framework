<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Filesystem\File\Locator;

use Laventure\Component\Filesystem\File\Locator\FileLocator;
use PHPUnit\Framework\TestCase;

/**
 * FileLocatorTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Common\File\Locator
*/
class FileLocatorTest extends TestCase
{
    public function testIfLocateCorrectlyPath(): void
    {
        $locator = new FileLocator(__DIR__.'/config');

        $expect = [
            'name' => 'Laventure',
            'database' => [
                'driver' => 'mysql',
                'host' => '127.0.0.1',
                'dbname' => 'laventure.php',
                'user' => 'root',
                'password' => 'secret'
            ]
        ];


        $this->assertIsArray(require $locator->locate('app.php'));
        $this->assertSame($expect, require $locator->locate('app.php'));
    }
}
