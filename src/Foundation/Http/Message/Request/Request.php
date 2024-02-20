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
use Psr\Http\Message\UploadedFileInterface;
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
     * @param string $method
     * @param string $url
    */
    public function __construct(string $method, string $url)
    {
        $this->method     = $method;
        $this->target     = $url;
        $this->queries    = new InputBag();
        $this->request    = new InputBag();
        $this->attributes = new ParameterBag();
        $this->cookies    = new InputBag();
        $this->files      = new InputBag();
        $this->server     = new ServerBag();
        $this->headers    = new HeaderBag();
    }








    /**
     * @param string $method
     * @return $this
    */
    public function withMethod(string $method): static
    {
        $this->method = $method;

        return $this;
    }





    /**
     * @return string
    */
    public function getMethod(): string
    {
        return $this->method;
    }





    /**
     * @param UriInterface $uri
     * @return $this
    */
    public function withUri(UriInterface $uri): static
    {
        $this->uri = $uri;

        return $this;
    }





    /**
     * @return UriInterface
    */
    public function getUri(): UriInterface
    {
        return $this->uri;
    }







    /**
     * @param string $target
     * @return $this
    */
    public function withTarget(string $target): static
    {
        $this->target = $target;

        return $this;
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
     * @param array $queries
     * @return $this
     */
    public function withQueryParams(array $queries): static
    {
        $this->queries->add($queries);

        return $this;
    }






    /**
     * @return array
     */
    public function getQueryParams(): array
    {
        return $this->queries->all();
    }





    /**
     * @param array $parsedBody
     * @return $this
     */
    public function withParsedBody(array $parsedBody): static
    {
        $this->request->add($parsedBody);

        return $this;
    }






    /**
     * @return array
     */
    public function getParsedBody(): array
    {
        return $this->request->all();
    }






    /**
     * @param array $attributes
     * @return $this
     */
    public function withAttributes(array $attributes): static
    {
        $this->attributes->add($attributes);

        return $this;
    }





    /**
     * @return array
     */
    public function getAttributes(): array
    {
        return $this->attributes->all();
    }






    /**
     * @param array $cookieParams
     * @return $this
     */
    public function withCookieParams(array $cookieParams): static
    {
        $this->cookies->add($cookieParams);

        return $this;
    }






    /**
     * @return array
     */
    public function getCookieParams(): array
    {
        return $this->cookies->all();
    }






    /**
     * @param UploadedFileInterface[] $uploadedFiles
     * @return $this
     */
    public function withUploadedFiles(array $uploadedFiles): static
    {
        $this->files->add($uploadedFiles);

        return $this;
    }





    /**
     * @return UploadedFileInterface[]
     */
    public function getUploadedFiles(): array
    {
        return $this->files->all();
    }





    /**
     * @param array $serverParams
     * @return $this
     */
    public function withServerParams(array $serverParams): static
    {
        $this->server->add($serverParams);

        return $this;
    }





    /**
     * @return array
    */
    public function getServerParams(): array
    {
        return $this->server->all();
    }






    /**
     * @param array $headers
     * @return $this
     */
    public function withHeaders(array $headers): static
    {
        $this->headers->add($headers);

        return $this;
    }





    /**
     * @param $key
     * @param $value
     * @return $this
    */
    public function withHeader($key, $value): static
    {
        $this->headers->set($key, (array)$value);

        return $this;
    }





    /**
     * @return array
    */
    public function getHeaders(): array
    {
        return $this->headers->all();
    }






    /**
     * @return string
    */
    public function getUrl(): string
    {
        return $this->target;
    }





    /**
     * @return string
    */
    public function getBaseUrl(): string
    {
        return $this->server->getBaseUrl();
    }





    /**
     * @return static
    */
    public static function createFromGlobals(): static
    {
        $serverRequest = ServerRequest::fromGlobals();
        $request = new static(
            $serverRequest->getMethod(),
            $serverRequest->getRequestTarget()
        );

        return $request->withUri($serverRequest->getUri())
                       ->withBody($serverRequest->getBody())
                       ->withServerParams($serverRequest->getServerParams())
                       ->withQueryParams($serverRequest->getQueryParams())
                       ->withParsedBody($serverRequest->getParsedBody())
                       ->withUploadedFiles($serverRequest->getUploadedFiles())
                       ->withAttributes($serverRequest->getAttributes())
                       ->withCookieParams($serverRequest->getCookieParams())
                       ->withHeaders($serverRequest->getHeaders());
    }
}
