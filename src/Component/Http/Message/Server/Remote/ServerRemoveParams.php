<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server\Remote;

use Laventure\Component\Http\Message\Server\ServerParamInterface;

/**
 * ServerRemoveParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Server\Remote
*/
class ServerRemoveParams implements ServerRemoteParamInterface
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
    public function getAddress(): string
    {
        return $this->server->string('REMOTE_ADDR');
    }





    /**
     * @inheritDoc
    */
    public function getPort(): int
    {
        return $this->server->integer('REMOTE_PORT');
    }





    /**
     * @inheritDoc
    */
    public function getIp(): int
    {
        return 0;
    }
}