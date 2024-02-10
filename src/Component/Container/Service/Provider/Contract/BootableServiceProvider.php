<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Service\Provider\Contract;

/**
 * BootableServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Service\Provider\Drivers
 */
interface BootableServiceProvider
{
    /**
     * Boot service provider
     *
     * @return void
    */
    public function boot(): void;
}
