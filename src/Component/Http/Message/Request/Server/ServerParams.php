<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server;

use Laventure\Component\Http\Message\Request\Server\Headers\ServerHeaderInterface;
use Laventure\Component\Http\Message\Request\Server\Headers\ServerHeaderParams;
use Laventure\Component\Http\Message\Request\Server\Protocol\ServerProtocol;
use Laventure\Component\Http\Message\Request\Server\Protocol\ServerProtocolInterface;
use Laventure\Component\Http\Message\Request\Server\Remote\ServerRemote;
use Laventure\Component\Http\Message\Request\Server\Remote\ServerRemoteInterface;
use Laventure\Component\Http\Message\Request\Server\Script\ServerScriptInterface;
use Laventure\Component\Http\Message\Request\Server\Script\ServerScript;
use Laventure\Component\Http\Message\Request\Uri;
use Psr\Http\Message\UriInterface;
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
    public function getDocumentRoot(): string
    {
        return $this->string('DOCUMENT_ROOT');
    }




    /**
     * @inheritDoc
    */
    public function getMethod(): string
    {
        return $this->toUpper('REQUEST_METHOD');
    }




    /**
     * @inheritDoc
     */
    public function setMethod(string $method): static
    {
        $this->set('REQUEST_METHOD', strtoupper($method));

        return $this;
    }




    /**
     * @inheritDoc
     */
    public function getRequestUri(): string
    {
        return $this->string('REQUEST_URI');
    }






    /**
     * @inheritDoc
     */
    public function getRequestTime(): int
    {
        return $this->integer("REQUEST_TIME");
    }




    /**
     * @inheritDoc
     */
    public function getRequestTimeAsFloat(): float
    {
        return $this->float("REQUEST_TIME_FLOAT");
    }





    /**
     * @inheritDoc
    */
    public function getSelfPath(): string
    {
        return $this->string('PHP_SELF');
    }






    /**
     * @inheritdoc
     */
    public function getReferer(): string
    {
        return $this->string('HTTP_REFERER');
    }





    /**
     * @inheritDoc
     */
    public function getUrl(): string
    {
        return strval($this->getUri());
    }






    /**
     * @inheritDoc
     */
    public function getBaseUrl(): string
    {
        return str_replace($this->getRequestUri(), '', $this->getUrl());
    }






    /**
     * @inheritdoc
     */
    public function getScheme(): string
    {
        return $this->isSecure() ? 'https' : 'http';
    }





    /**
     * @inheritDoc
    */
    public function getUsername(): string
    {
        return $this->string('PHP_AUTH_USER');
    }




    /**
     * @inheritDoc
    */
    public function getPassword(): string
    {
        return $this->string('PHP_AUTH_PW');
    }






    /**
     * @inheritDoc
     */
    public function getAuthority(): string
    {
        if (!$user = $this->getUsername()) {
            return '';
        }

        return sprintf('%s:%s@', $user, $this->getPassword());
    }







    /**
     * @inheritDoc
     */
    public function getPathInfo(): string
    {
        $path = strtok($this->getRequestUri(), '?');

        return $this->get('PATH_INFO', $path);
    }





    /**
     * @inheritDoc
     */
    public function getQueryString(): string
    {
        return $this->string('QUERY_STRING');
    }





    /**
     * @inheritdoc
     */
    public function getPort(): int
    {
        return $this->integer('SERVER_PORT');
    }






    /**
     * @inheritdoc
     */
    public function getHost(): string
    {
        $host = $this->string('HTTP_HOST');

        if($this->getPort()) {
            return explode(':', $host)[0];
        }

        return $host;
    }





    /**
     * @inheritDoc
     */
    public function getUri(): UriInterface
    {
        return (new Uri())
             ->withScheme($this->getScheme())
             ->withUserInfo($this->getUsername(), $this->getPassword())
             ->withHost($this->getHost())
             ->withPort($this->getPort())
             ->withPath($this->getPathInfo())
             ->withQuery($this->getQueryString());
    }







    /**
     * @inheritdoc
     */
    public function isXhr(): bool
    {
        return $this->eq('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
    }







    /**
     * @inheritdoc
     */
    public function isForwardedProto(): bool
    {
        return $this->get('HTTP_X_FORWARDED_PROTO') == 'https';
    }





    /**
     * @inheritdoc
     */
    public function isHttps(): bool
    {
        return $this->has('HTTPS') || $this->isForwardedProto();
    }





    /**
     * @inheritdoc
    */
    public function isSecure(): bool
    {
        return $this->isHttps() && $this->getPort() == 443;
    }





    /**
     * @inheritdoc
    */
    public function getHeaders(): ServerHeaderInterface
    {
        return new ServerHeaderParams($this);
    }






    /**
     * @inheritdoc
    */
    public function getProtocol(): ServerProtocolInterface
    {
        return new ServerProtocol($this);
    }







    /**
     * @inheritdoc
    */
    public function getScript(): ServerScriptInterface
    {
        return new ServerScript($this);
    }






    /**
     * @inheritDoc
    */
    public function getRemote(): ServerRemoteInterface
    {
        return new ServerRemote($this);
    }




    /**
     * @inheritDoc
    */
    public function isValidHost($host): bool
    {
        return boolval(preg_match('#^'. $host .'$#', $this->getHost()));
    }
}
