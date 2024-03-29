<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Controller\NotFound;

use Laventure\Component\Http\Message\Response\Response;
use Laventure\Foundation\Http\Message\Request\Request;

/**
 * NotFoundController
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Controller\NotFound
*/
class NotFoundController
{
    /**
     * @param Request $request
     * @return Response
    */
    public function index(Request $request): Response
    {
        return new NotFoundResponse();
    }
}
