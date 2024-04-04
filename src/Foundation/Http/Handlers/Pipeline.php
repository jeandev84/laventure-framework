<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Handlers;

use Laventure\Component\Http\Handlers\Contract\PipelineInterface;
use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Application;

/**
 * Pipeline
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Handlers
*/
class Pipeline implements PipelineInterface
{
    /**
     * @var Application
    */
    protected Application $app;


    /**
     * @var MiddlewareStackHandler
    */
    protected MiddlewareStackHandler $handler;




    /**
     * @param Application $app
    */
    public function __construct(Application $app)
    {
        $this->app     = $app;
        $this->handler = $app[MiddlewareStackHandler::class];
    }




    /**
     * @inheritdoc
    */
    public function pipe(array $middlewares): static
    {
        foreach ($middlewares as $middleware) {
            $this->handler->add($this->app->get($middleware));
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function handle($request): Response
    {
        return $this->handler->handle($request);
    }
}
