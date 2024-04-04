<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Handlers\Contract;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * HandlerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Handlers\Writer
 */
interface HandlerInterface
{
    /**
     * @param Request $request
     * @return Response
    */
    public function handle(Request $request): Response;
}
