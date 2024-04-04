<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Controller\NotFound;

use Laventure\Component\Http\Message\Response\Response;

/**
 * NotFoundResponse
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Controller\NotFound
*/
class NotFoundResponse extends Response
{
    public function __construct(array $headers = [])
    {
        $template = new NotFoundTemplate();
        parent::__construct(404, $headers);
        $this->setContent($template->__toString());
    }
}
