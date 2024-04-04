<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Facade;

use Laventure\Component\Container\Facade\Facade;

/**
 * TestFacade
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Facade
 */
class TestFacade extends Facade
{
    protected static function getFacadeAccessor(): string
    {
        return 'test.service';
    }
}
