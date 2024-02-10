<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Handlers;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Component\Templating\Template\Template;
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
     * @inheritdoc
    */
    public function handle(Request $request): Response
    {
        $template = new Template(__DIR__.'/resource/views/404.html');

        return (new Response(404))->setContent(strval($template));
    }
}
