<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Message\Request;

use Laventure\Component\Http\Message\Request\ServerRequest;
use Laventure\Component\Http\Storage\Session\SessionInterface;
use Laventure\Foundation\Http\Message\Request\Bag\HeaderBag;
use Laventure\Foundation\Http\Message\Request\Bag\InputBag;
use Laventure\Foundation\Http\Message\Request\Bag\ParameterBag;
use Laventure\Foundation\Http\Message\Request\Bag\ServerBag;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\StreamInterface;
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
final class Request
{
    /**
     * @var string
    */
    private string $method;



    /**
     * @var string
     *
     * Example http://localhost:8080/admin/category?page=1&sort=category.id&direction=asc
    */
    private string $target;




    /**
     * @var UriInterface|string
    */
    private UriInterface|string $uri;



    /**
     * @var StreamInterface
    */
    private StreamInterface $body;




    /**
     * get query params from $_GET
     *
     * @var InputBag
    */
    public InputBag $queries;




    /**
     * get params from request $_POST
     *
     * @var InputBag
    */
    public InputBag $request;



    /**
     * @var ParameterBag
    */
    public ParameterBag $attributes;



    /**
     * get data from $_COOKIE
     *
     * @var InputBag
    */
    public InputBag $cookies;




    /**
     * get data from $_FILES
     *
     * @var InputBag
    */
    public InputBag $files;




    /**
     * get data from $_SERVER
     *
     * @var ServerBag
    */
    public ServerBag $server;




    /**
     * @var HeaderBag
    */
    public HeaderBag $headers;






    /**
     * @var SessionInterface|null
    */
    public ?SessionInterface $session = null;





    /**
     * @param ServerRequestInterface $request
    */
    public function __construct(ServerRequestInterface $request)
    {
        $this->method     = $request->getMethod();
        $this->target     = $request->getRequestTarget();
        $this->uri        = $request->getUri();
        $this->body       = $request->getBody();
        $this->queries    = new InputBag($request->getQueryParams());
        $this->request    = new InputBag($request->getParsedBody());
        $this->attributes = new ParameterBag($request->getAttributes());
        $this->cookies    = new InputBag($request->getCookieParams());
        $this->files      = new InputBag($request->getUploadedFiles());
        $this->server     = new ServerBag($request->getServerParams());
        $this->headers    = new HeaderBag($request->getHeaders());
    }




    /**
     * @param StreamInterface $body
     *
     * @return $this
    */
    public function withBody(StreamInterface $body): static
    {
        $this->body = $body;

        return $this;
    }



    /**
     * @return StreamInterface
    */
    public function getBody(): StreamInterface
    {
        return $this->body;
    }




    /**
     * @return string
    */
    public function url(): string
    {
        return $this->target;
    }





    /**
     * @return string
    */
    public function baseUrl(): string
    {
        return $this->server->getBaseUrl();
    }





    /**
     * @return UriInterface
    */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }




    /**
     * @return string
    */
    public function getMethod(): string
    {
        return $this->method;
    }




    /**
     * @return static
    */
    public static function createFromGlobals(): static
    {
        return new self(ServerRequest::fromGlobals());
    }
}
