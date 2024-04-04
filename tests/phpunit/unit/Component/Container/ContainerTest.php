<?php

declare(strict_types=1);

namespace PHPUnitTest\Component\Container;

use Laventure\Component\Config\Config;
use Laventure\Component\Config\ConfigInterface;
use Laventure\Component\Container\Container;
use Laventure\Component\Container\ContainerAwareInterface;
use PHPUnit\Framework\TestCase;
use PHPUnitTest\App\Facade\TestFacade;
use PHPUnitTest\App\Http\Controllers\TestController;
use PHPUnitTest\App\Providers\ConfigServiceProvider;
use PHPUnitTest\App\Providers\TestServiceProvider;
use PHPUnitTest\App\Service\Mailer\Envelop;
use PHPUnitTest\App\Service\Mailer\MailService;
use PHPUnitTest\App\Service\Mailer\MailServiceInterface;
use PHPUnitTest\App\Service\TestService;
use PHPUnitTest\App\Service\User\UserService;
use PHPUnitTest\Component\Container\Utils\FakeContainer;
use Psr\Container\ContainerInterface;
use Throwable;

/**
 * ContainerTest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\Component\Container
 */
class ContainerTest extends TestCase
{
    /**
     * @var Container
    */
    protected Container $container;



    /**
     * @return void
    */
    protected function setUp(): void
    {
        $container = Container::getInstance();
        $container->aliases(Container::class, ['app']);
        $container->singleton(Container::class, $container);
        $container->singleton(ContainerInterface::class, Container::class);
        $this->container = $container;
    }




    public function testItGivenAlwaysTheSameInstance(): void
    {
        $instance1  = new Container();
        $instance2  = new Container();
        $container1 = Container::getInstance();
        $container2 = Container::getInstance();

        $this->assertInstanceOf(ContainerInterface::class, $container1);
        $this->assertInstanceOf(ContainerInterface::class, $container2);
        $this->assertSame($container1, $container2);
        $this->assertNotSame($instance1, $container1);
        $this->assertNotSame($instance2, $container2);
        $this->assertNotSame($instance1, $instance2);
        $this->assertNotInstanceOf(ContainerInterface::class, new FakeContainer());
    }





    public function testItMakeInstanceWithParameters(): void
    {
        $this->assertInstanceOf(MailService::class, $this->container->make(MailService::class, [
            'from' => 'admin@site.ru'
        ]));
    }






    public function testFactory(): void
    {
        $envelop1 = $this->container->factory(Envelop::class);
        $envelop2 = $this->container->factory(Envelop::class);

        $this->assertInstanceOf(Envelop::class, $envelop1);
        $this->assertInstanceOf(Envelop::class, $envelop2);
        $this->assertNotSame($envelop1, $envelop2);
    }





    public function testItRetrieveValue(): void
    {
        $url = 'http://localhost:8000';
        $this->container->bind('url', $url);
        $this->container->bind('from', 'no-reply@site.ru');
        $this->container->bind('mail', function (Container $c) {
            return new MailService($c['from']);
        });
        $this->container->singleton(MailServiceInterface::class, MailService::class);


        $this->assertSame($url, $this->container['url']);
        $this->assertInstanceOf(Container::class, $this->container['app']);
        $this->assertInstanceOf(MailService::class, $this->container['mail']);
        $this->assertInstanceOf(MailService::class, $this->container[MailService::class]);
        $this->assertInstanceOf(UserService::class, $this->container[UserService::class]);
    }



    public function testThrowsContainerExceptionWhenGivenWrongId(): void
    {
        $this->expectException(Throwable::class);

        $this->container->get('foo.service');
    }




    public function testSingleton(): void
    {
        $this->container->aliases(Envelop::class, ['envelop']);
        $this->container->singleton(Envelop::class, Envelop::class);

        $envelop1 = $this->container[Envelop::class];
        $envelop2 = $this->container[Envelop::class];
        $envelop3 = $this->container['envelop'];

        $this->assertSame(Container::getInstance(), $this->container);
        $this->assertSame($envelop1, $envelop2);
        $this->assertSame($envelop1, $envelop3);
        $this->assertSame($envelop2, $envelop1);
        $this->assertSame($envelop2, $envelop3);
    }





    public function testProviders(): void
    {
        $providers = [
            ConfigServiceProvider::class,
            TestServiceProvider::class
        ];

        $this->container->addProviders($providers);


        foreach ($providers as $provider) {
            $this->assertArrayHasKey($provider, $this->container->getProviders());
        }

        $this->assertSame($this->container['app.demo'], $this->container[Config::class]);
        $this->assertSame($this->container[ConfigInterface::class], $this->container[Config::class]);
        $this->assertSame($this->container['test'], $this->container[TestService::class]);
        $this->assertSame('BootedConfig', $this->container['demo.booted']);
    }




    public function testFacadeItWorks(): void
    {
        $this->container->singleton('test.service', TestService::class);

        $this->container->addFacades([
            TestFacade::class
        ]);

        $this->assertArrayHasKey(TestFacade::class, $this->container->getFacades());
        $this->assertSame(TestService::class, TestFacade::getServiceName());
        $this->assertSame('foo.service', TestFacade::fooService());
    }




    public function testCall(): void
    {
        $this->container->bind('from', 'no-reply@site.ru');
        $this->container->bind('host', '127.0.0.1:8000');
        $this->container->singleton(MailServiceInterface::class, MailService::class);
        $response = $this->container->call(TestController::class, 'index', [
            'id' => 1
        ]);

        $this->assertSame("foo.service#1#127.0.0.1:8000", $response);
        $this->assertInstanceOf(ContainerAwareInterface::class, $this->container[TestController::class]);
    }




    public function testValueAlreadyResolved(): void
    {
        $this->container->bind('from', 'no-reply@site.ru');
        $this->container->singleton(MailServiceInterface::class, MailService::class);
        $mailService = $this->container[MailServiceInterface::class];

        $this->assertTrue($this->container->shared(MailServiceInterface::class));
        $this->assertTrue($this->container->resolved(MailService::class));
        $this->assertSame($mailService, $this->container[MailServiceInterface::class]);
    }






    /**
     * @return void
    */
    protected function tearDown(): void
    {
        $this->container->clear();
    }
}
