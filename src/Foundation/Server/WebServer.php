<?php

declare(strict_types=1);

namespace Laventure\Foundation\Server;

use Laventure\Foundation\Server\Contract\WebServerInterface;

/**
 * WebServer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Server
 */
class WebServer implements WebServerInterface
{
    /**
     * @inheritDoc
    */
    public function getInfo(): bool
    {
        return phpinfo();
    }
}
