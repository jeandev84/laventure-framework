<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server;

use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\Server\Authority\ServerAuthorityParamInterface;
use Laventure\Component\Http\Message\Server\Authority\ServerAuthorityParams;
use Laventure\Component\Http\Message\Server\Headers\ServerHeaderParamInterface;
use Laventure\Component\Http\Message\Server\Headers\ServerHeaderParams;
use Laventure\Component\Http\Message\Server\Protocol\ServerProtocolParamInterface;
use Laventure\Component\Http\Message\Server\Protocol\ServerProtocolParams;
use Laventure\Component\Http\Message\Server\Request\ServerRequestParamInterface;
use Laventure\Component\Http\Message\Server\Request\ServerRequestParams;
use Laventure\Component\Http\Message\Server\Script\ServerScriptParamInterface;
use Laventure\Component\Http\Message\Server\Script\ServerScriptParams;
use Laventure\Utils\Parameter\Parameter;

/**
 * ServerParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Utils\Params
*/
class ServerParams extends Parameter implements ServerParamInterface
{
    /**
     * @inheritdoc
    */
    public function getName(): string
    {
        return $this->string('SERVER_NAME');
    }





    /**
     * @inheritdoc
    */
    public function getHeaders(): ServerHeaderParamInterface
    {
        return new ServerHeaderParams($this);
    }






    /**
     * @inheritdoc
    */
    public function getProtocol(): ServerProtocolParamInterface
    {
        return new ServerProtocolParams($this);
    }






    /**
     * @inheritdoc
    */
    public function getRequest(): ServerRequestParamInterface
    {
        return new ServerRequestParams($this);
    }






    /**
     * @inheritdoc
    */
    public function getDocumentRoot(): string
    {
        return $this->string('DOCUMENT_ROOT');
    }






    /**
     * @inheritdoc
    */
    public function getScript(): ServerScriptParamInterface
    {
        return new ServerScriptParams($this);
    }
}
