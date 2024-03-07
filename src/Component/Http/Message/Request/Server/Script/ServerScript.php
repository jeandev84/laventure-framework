<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server\Script;

use Laventure\Component\Http\Message\Request\Server\ServerParamInterface;

/**
 * ServerScript
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Server\Script
*/
class ServerScript implements ServerScriptInterface
{
    /**
     * @param ServerParamInterface $server
    */
    public function __construct(protected ServerParamInterface $server)
    {
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->server->string('SCRIPT_NAME');
    }




    /**
     * @inheritDoc
    */
    public function getFileName(): string
    {
        return $this->server->string('SCRIPT_FILENAME');
    }
}
