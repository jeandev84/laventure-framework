<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Handlers\Middleware;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Http\Handlers\Contract\HandlerInterface;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * Middleware
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Handlers\Middleware
 */
interface Middleware
{
    /**
     * @param Request $request
     *
     * @param HandlerInterface $next
     *
     * @return Response
    */
    public function process(Request $request, HandlerInterface $next): Response;
}
