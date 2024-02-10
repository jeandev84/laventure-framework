<?php
declare(strict_types=1);

namespace Laventure\Foundation\Container\Service\Providers;

use Laventure\Component\Container\Exception\ContainerException;
use Laventure\Component\Container\Service\Provider\Contract\BootableServiceProvider;
use Laventure\Component\Container\Service\Provider\ServiceProvider;
use Psr\Http\Message\ResponseFactoryInterface;
use ReflectionException;

/**
 * ApplicationServiceProvider
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Container\Service\Providers
 */
class ApplicationServiceProvider extends ServiceProvider implements BootableServiceProvider
{


    /**
     * @var array|array[]
    */
    protected array $provides = [
        ResponseFactoryInterface::class => []
    ];


    /**
     * @inheritDoc
    */
    public function boot(): void
    {
        $this->loadHelpers();
        $this->loadFacades();
    }






    /**
     * @inheritDoc
    */
    public function register(): void
    {

    }




    /**
     * @return void
    */
    private function loadHelpers(): void
    {
        require_once realpath(__DIR__.'/../helpers.php');
    }




    /**
     * @return void
     * @throws ContainerException
     * @throws ReflectionException
    */
    private function loadFacades(): void
    {
        $this->app->addFacades([
            //TODO add some facades here
        ]);
    }
}