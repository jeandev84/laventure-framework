<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service;

/**
 * TestService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service
 */
class TestService
{
    public static function getServiceName(): string
    {
        return get_called_class();
    }



    public function fooService(): string
    {
        return 'foo.service';
    }
}
