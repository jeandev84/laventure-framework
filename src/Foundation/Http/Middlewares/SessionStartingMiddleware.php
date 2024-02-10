<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Middlewares;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Http\Handlers\Contract\HandlerInterface;
use Laventure\Foundation\Http\Handlers\Middleware\Middleware;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * SessionStartingMiddleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Middlewares
*/
class SessionStartingMiddleware implements Middleware
{
    /**
     * @inheritDoc
    */
    public function process(Request $request, HandlerInterface $next): Response
    {
        return $next->handle($request);
    }
}
