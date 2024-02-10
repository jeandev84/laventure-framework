<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Http\Controllers;

use Laventure\Component\Container\Container;
use Laventure\Component\Container\ContainerAwareInterface;
use PHPUnitTest\App\Service\Mailer\MailServiceInterface;
use PHPUnitTest\App\Service\TestService;

/**
 * TestController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Http\Controllers
 */
class TestController implements ContainerAwareInterface
{
    /**
     * @var MailServiceInterface
    */
    protected MailServiceInterface $mailService;


    /**
     * @var Container
    */
    protected Container $container;



    /**
     * @param MailServiceInterface $mailService
    */
    public function __construct(MailServiceInterface $mailService)
    {
        $this->mailService = $mailService;
    }





    /**
     * @inheritDoc
    */
    public function setContainer(Container $container): void
    {
        $this->container = $container;
    }




    /**
     * @inheritDoc
    */
    public function getContainer(): Container
    {
        return $this->container;
    }






    /**
     * @param TestService $service
     * @param int $id
     * @return string
    */
    public function index(TestService $service, int $id): string
    {
        return $service->fooService() . "#$id#{$this->container['host']}";
    }
}
