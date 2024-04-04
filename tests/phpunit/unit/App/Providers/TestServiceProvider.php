<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Providers;

use Laventure\Component\Container\Service\Provider\ServiceProvider;
use PHPUnitTest\App\Service\TestService;

/**
 * TestServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Providers
 */
class TestServiceProvider extends ServiceProvider
{
    protected array $provides = [
        'test' => [
            TestService::class
        ]
    ];






    /**
     * @inheritDoc
     */
    public function register(): void
    {
        $this->app->singleton('test', function () {
            return $this->app->factory(TestService::class);
        });
    }
}
