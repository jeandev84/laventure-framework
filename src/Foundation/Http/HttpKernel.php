<?php
declare(strict_types=1);

namespace Laventure\Foundation\Http;

use Laventure\Component\Http\Kernel\Contract\HttpKernelInterface;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Application;
use Laventure\Foundation\Http\Handlers\Pipeline;
use Laventure\Foundation\Http\Message\Request\Request;
use Laventure\Foundation\Http\Middlewares\AuthenticatedMiddleware;
use Laventure\Foundation\Http\Middlewares\BufferMiddleware;
use Laventure\Foundation\Http\Middlewares\CsrfTokenMiddleware;
use Laventure\Foundation\Http\Middlewares\GuestMiddleware;
use Laventure\Foundation\Http\Middlewares\MethodOverrideMiddleware;
use Laventure\Foundation\Http\Middlewares\RouteDispatcherMiddleware;
use Laventure\Foundation\Http\Middlewares\SessionStartingMiddleware;
use Throwable;

/**
 * HttpKernel
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Web\Http\Kernel
 */
class HttpKernel implements HttpKernelInterface
{
    /**
     * @var Application
    */
    protected Application $app;



    /**
     * priority middlewares
     *
     * @var string[]
    */
    private array $middlewarePriority = [
        BufferMiddleware::class,
        SessionStartingMiddleware::class,
        MethodOverrideMiddleware::class,
        CsrfTokenMiddleware::class,
        AuthenticatedMiddleware::class,
        GuestMiddleware::class,
        RouteDispatcherMiddleware::class
    ];



    /**
     * priority route middlewares
     *
     * @var string[]
    */
    protected array $routeMiddlewares = [];




    /**
     * @param Application $app
    */
    public function __construct(Application $app)
    {
        $this->app = $app;
    }




    /**
     * @inheritDoc
    */
    public function handle($request): Response
    {
        try {
            $response =  $this->dispatchRoute($request);
        } catch (Throwable $e) {
            $response = $this->exceptionResponse($e);
        }

        // TODO load events before returns response
        return $response;
    }




    /**
     * @param Request $request
     * @return Response
    */
    private function dispatchRoute(Request $request): Response
    {
        $this->app->instance(Request::class, $request);

        return (new Pipeline($this->app))
               ->pipe($this->middlewares())
               ->handle($request);
    }





    /**
     * @param Throwable $e
     * @return Response
    */
    private function exceptionResponse(Throwable $e): Response
    {
        // TODO refactoring
        $response = new Response();
        $response->setContent($e->getMessage());
        return $response;
    }





    /**
     * @inheritDoc
    */
    public function terminate($request, $response): void
    {
          //TODO terminate application
    }





    private function middlewares(): array
    {
        return array_merge(
            $this->middlewarePriority,
            $this->routeMiddlewares
        );
    }
}
