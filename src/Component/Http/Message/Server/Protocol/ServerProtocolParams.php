<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server\Protocol;


use Laventure\Component\Http\Message\Server\ServerParamInterface;

/**
 * ServerProtocol
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Params
*/
class ServerProtocolParams implements ServerProtocolParamInterface
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
    public function getVersion(): int
    {
        $protocol = $this->server->string('SERVER_PROTOCOL');

        return intval(str_replace('HTTP/', '', $protocol));
    }
}