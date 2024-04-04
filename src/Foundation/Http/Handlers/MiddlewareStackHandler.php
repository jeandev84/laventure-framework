<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Handlers;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Http\Handlers\Contract\HandlerInterface;
use Laventure\Foundation\Http\Handlers\Middleware\Middleware;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * MiddlewareStackHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Handlers
*/
class MiddlewareStackHandler implements HandlerInterface
{
    /**
     * @var Middleware[]
    */
    protected array $middlewares = [];



    /**
     * @var NotFoundHandler $fallbackHandler
    */
    protected $fallbackHandler;



    /**
     * @param NotFoundHandler $fallbackHandler
    */
    public function __construct(NotFoundHandler $fallbackHandler)
    {
        $this->fallbackHandler = $fallbackHandler;
    }




    /**
     * @param Middleware $middleware
     *
     * @return $this
    */
    public function add(Middleware $middleware): static
    {
        $this->middlewares[] = $middleware;

        return $this;
    }




    /**
     * @inheritdoc
    */
    public function handle(Request $request): Response
    {
        // Last middleware in the queue has called on the request handler.
        if (0 === count($this->middlewares)) {
            return $this->fallbackHandler->handle($request);
        }

        $middleware = array_shift($this->middlewares);
        return $middleware->process($request, $this);
    }
}
