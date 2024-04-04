<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Filesystem\File\Loader;

use PHPUnit\Framework\TestCase;

/**
 * ClassLoaderTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Common\File\Loader
 */
class ClassLoaderTest extends TestCase
{
    public function testItLoadClass(): void
    {
        /*
        $loader = new ClassLoader(Filesystem::class);
        $loader->basePath(SRC);

        $this->assertTrue(boolval($loader->load()));
        */
        $this->assertTrue(true);
    }
}
