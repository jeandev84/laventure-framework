<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Server\Request;

use Laventure\Component\Http\Message\Request\Uri;
use Laventure\Component\Http\Message\Server\ServerParamInterface;
use Psr\Http\Message\UriInterface;

/**
 * ServerRequestParams
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Request
*/
class ServerRequestParams implements ServerRequestParamInterface
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
    public function getMethod(): string
    {
        return $this->server->toUpper('REQUEST_METHOD');
    }




    /**
     * @inheritDoc
    */
    public function setMethod(string $method): static
    {
        $this->server->set('REQUEST_METHOD', strtoupper($method));

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getRequestUri(): string
    {
        return $this->server->string('REQUEST_URI');
    }






    /**
     * @inheritDoc
    */
    public function getTime(): int
    {
        return $this->server->integer("REQUEST_TIME");
    }




    /**
     * @inheritDoc
    */
    public function getTimeAsFloat(): float
    {
        return $this->server->float("REQUEST_TIME_FLOAT");
    }





    /**
     * @inheritDoc
    */
    public function getSelfPath(): string
    {
        return $this->server->string('PHP_SELF');
    }






    /**
     * @inheritdoc
    */
    public function getReferer(): string
    {
        return $this->server->string('HTTP_REFERER');
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
        return $this->server->string('PHP_AUTH_USER');
    }




    /**
     * @inheritDoc
     */
    public function getPassword(): string
    {
        return $this->server->string('PHP_AUTH_PW');
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

        return $this->server->get('PATH_INFO', $path);
    }





    /**
     * @inheritDoc
    */
    public function getQueryString(): string
    {
        return $this->server->string('QUERY_STRING');
    }





    /**
     * @inheritdoc
    */
    public function getPort(): int
    {
        return $this->server->integer('SERVER_PORT');
    }






    /**
     * @inheritdoc
    */
    public function getHost(): string
    {
        $host = $this->server->string('HTTP_HOST');

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
        return $this->server->eq('HTTP_X_REQUESTED_WITH', 'XMLHttpRequest');
    }







    /**
     * @inheritdoc
    */
    public function isForwardedProto(): bool
    {
        return $this->server->get('HTTP_X_FORWARDED_PROTO') == 'https';
    }





    /**
     * @inheritdoc
    */
    public function isHttps(): bool
    {
        return $this->server->has('HTTPS') || $this->isForwardedProto();
    }





    /**
     * @inheritdoc
    */
    public function isSecure(): bool
    {
        return $this->isHttps() && $this->getPort() == 443;
    }
}