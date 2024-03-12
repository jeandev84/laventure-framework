<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Message\Request;

use Laventure\Component\Http\Message\Request\Server\ServerParamInterface;
use Laventure\Component\Http\Message\Request\Server\ServerParams;
use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Storage\Cookie\Jar\CookieJar;
use Laventure\Component\Http\Storage\Cookie\Jar\CookieJarInterface;
use Laventure\Component\Http\Storage\Session\SessionInterface;
use Laventure\Foundation\Http\Message\Request\Constract\CustomRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * Request
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Web\Http\Request
*/
class Request extends ServerRequest implements CustomRequestInterface
{
    /**
     * @var SessionInterface|null
    */
    public ?SessionInterface $session = null;



    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $server
    */
    public function __construct(string $method, UriInterface|string $uri, array $server = [])
    {
        parent::__construct($method, $uri, $server);
    }





    /**
     * @inheritDoc
    */
    public function withSession(SessionInterface $session): static
    {
        $this->session = $session;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getSession(): ?SessionInterface
    {
        return $this->session;
    }






    /**
     * @inheritDoc
    */
    public function getServer(): ServerParamInterface
    {
        return new ServerParams($this->server->all());
    }





    /**
     * @inheritDoc
    */
    public function getCookieJar(): CookieJarInterface
    {
        return new CookieJar($this->getCookieParams());
    }




    /**
     * @return bool
    */
    public function hasSession(): bool
    {
        return $this->session instanceof SessionInterface;
    }
}
