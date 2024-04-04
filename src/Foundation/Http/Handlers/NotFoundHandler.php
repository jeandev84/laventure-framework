<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Handlers;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Http\Controller\NotFound\NotFoundController;
use Laventure\Foundation\Http\Handlers\Contract\HandlerInterface;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * NotFoundHandler
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Handlers
*/
class NotFoundHandler implements HandlerInterface
{
    /**
     * @param NotFoundController $controller
    */
    public function __construct(protected NotFoundController $controller)
    {
    }



    /**
     * @inheritdoc
    */
    public function handle(Request $request): Response
    {
        return $this->controller->index($request);
    }
}
