<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Service\Provider\Contract;

/**
 * ServiceProviderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Service\Provider\Drivers
 */
interface ServiceProviderInterface
{
    /**
     * Register service in container
     *
     * @return void
    */
    public function register(): void;
}
