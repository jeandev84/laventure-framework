<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Middlewares;

use Laventure\Component\Container\Container;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Routing\Router\Router;
use Laventure\Foundation\Http\Handlers\Contract\HandlerInterface;
use Laventure\Foundation\Http\Handlers\Middleware\Middleware;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * RouteDispatchedMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Middlewares
 */
class RouteDispatcherMiddleware implements Middleware
{
    /**
     * @var Container
    */
    protected Container $app;



    /**
     * @var Router
    */
    protected Router $router;



    /**
     * @param Container $app
    */
    public function __construct(Container $app)
    {
        $this->app    = $app;
        $this->router = $app[Router::class];
    }




    /**
     * @inheritDoc
    */
    public function process(Request $request, HandlerInterface $next): Response
    {
        $path   = $request->getUri()->getPath();
        $method = $request->getMethod();
        $route  = $this->router->match($method, $path);

        if (!$route) {
            return $next->handle($request);
        }

        $request->attributes->add([
            '_route' => $route
        ]);

        $callback = $route->getAction();
        $middlewares = $route->getMiddlewares();

        if ($route->callable()) {
            return $this->app->callAnonymous($callback, [$request, $route->getParams()]);
        }

        [$controller, $action] = explode('::', $callback);

        $request->attributes->add([
            '_controller' => $route->getAction()
        ]);

        /* return call_user_func_array($callback, [$request]); */
        return $this->app->call($controller, $action, $route->getParams());
    }
}
