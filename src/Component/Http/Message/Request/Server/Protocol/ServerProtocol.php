<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server\Protocol;

use Laventure\Component\Http\Message\Request\Server\ServerParamInterface;

/**
 * ServerProtocol
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Params
*/
class ServerProtocol implements ServerProtocolInterface
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
        return $this->server->string('SERVER_PROTOCOL');
    }





    /**
     * @inheritDoc
    */
    public function getVersion(): string
    {
        $protocol = $this->server->string('SERVER_PROTOCOL');

        return str_replace('HTTP/', '', $protocol);
    }
}
