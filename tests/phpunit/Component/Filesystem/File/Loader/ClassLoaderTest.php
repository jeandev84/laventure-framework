<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Filesystem\File\Loader;

use Laventure\Component\Filesystem\File\Loader\ClassLoader;
use Laventure\Component\Filesystem\Filesystem;
use PHPUnit\Framework\TestCase;

/**
 * ClassLoaderTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Config\File\Loader
 */
class ClassLoaderTest extends TestCase
{
    public function testItLoadClass(): void
    {
        $loader = new ClassLoader(Filesystem::class);
        $loader->basePath(SRC);

        $this->assertTrue(boolval($loader->load()));
    }
}
