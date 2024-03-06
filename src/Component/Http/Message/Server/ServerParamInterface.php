<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server;


use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\Server\Authority\AuthorityParamInterface;
use Laventure\Component\Http\Message\Server\Authority\ServerAuthorityParamInterface;
use Laventure\Component\Http\Message\Server\Headers\ServerHeaderParamInterface;
use Laventure\Component\Http\Message\Server\Protocol\ServerProtocolParamInterface;
use Laventure\Component\Http\Message\Server\Remote\ServerRemoteParamInterface;
use Laventure\Component\Http\Message\Server\Request\ServerRequestParamInterface;
use Laventure\Component\Http\Message\Server\Script\ServerScriptParamInterface;
use Laventure\Contract\Parameter\ParameterInterface;
use Psr\Http\Message\UriInterface;

/**
 * ServerParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server
 */
interface ServerParamInterface extends ParameterInterface
{
    /**
     * Returns name of server
     *
     * @return string
    */
    public function getName(): string;






    /**
     * Returns headers information
     *
     * @return ServerHeaderParamInterface
    */
    public function getHeaders(): ServerHeaderParamInterface;






    /**
     * Returns information server protocol
     *
     * @return ServerProtocolParamInterface
    */
    public function getProtocol(): ServerProtocolParamInterface;






    /**
     * Returns information server request
     *
     * @return mixed
    */
    public function getRequest(): ServerRequestParamInterface;







    /**
     * Returns document root
     *
     * @return string
    */
    public function getDocumentRoot(): string;






    /**
     * @return ServerScriptParamInterface
    */
    public function getScript(): ServerScriptParamInterface;








    /**
     * Returns remote information
     *
     * @return ServerRemoteParamInterface
    */
    public function getRemote(): ServerRemoteParamInterface;
}