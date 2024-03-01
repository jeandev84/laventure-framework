<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Controller\NotFound;

use Laventure\Component\Templating\Template\Template;

/**
 * NotFoundTemplate
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Controller\NotFound
*/
class NotFoundTemplate extends Template
{
    public function __construct(array $parameters = [])
    {
        parent::__construct(__DIR__.'/resource/views/404.html', $parameters);
    }
}
