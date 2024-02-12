<?php

namespace PHPUnitTest\Dotenv;

use Laventure\Dotenv\Dotenv;
use PHPUnit\Framework\TestCase;

/**
 * DotenvTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Dotenv
 */
class DotenvTest extends TestCase
{
    public function testLoadEnvironments()
    {
        $dotenv = new Dotenv(__DIR__.'/config');
        $dotenv->load();

        $this->assertNotEmpty($dotenv->getCollection()->all());
    }
}
