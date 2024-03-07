<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Http\Bag\InputBag;
use Laventure\Component\Http\Bag\ParameterBag;
use Laventure\Component\Http\Bag\ServerBag;
use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Laventure\Component\Http\Message\Request\Server\ServerParams;
use Laventure\Component\Http\Message\Request\Utils\Normalizer\FileNormalizer;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Message\UriInterface;

/**
 * ServerRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request
*/
class ServerRequest extends Request implements ServerRequestInterface
{
    /**
     * @var ServerBag
    */
    public ServerBag $server;



    /**
     * @var ParameterBag
    */
    public ParameterBag $cookies;




    /**
     * @var InputBag
    */
    public InputBag $query;




    /**
     * @var ParameterBag
    */
    public ParameterBag $files;




    /**
     * @var InputBag
    */
    public InputBag $parsedBody;




    /**
     * @var ParameterBag
    */
    public ParameterBag $attributes;




    /**
     * @param string $method
     * @param UriInterface|string $uri
     * @param array $server
    */
    public function __construct(string $method, UriInterface|string $uri, array $server = [])
    {
        parent::__construct($method, $uri);
        $this->server     = new ServerBag($server);
        $this->cookies    = new ParameterBag();
        $this->query      = new InputBag();
        $this->files      = new ParameterBag();
        $this->parsedBody = new InputBag();
        $this->attributes = new ParameterBag();
    }




    /**
     * @inheritDoc
    */
    public function getServerParams(): array
    {
        return $this->server->all();
    }





    /**
     * @inheritDoc
    */
    public function getCookieParams(): array
    {
        return $this->cookies->all();
    }






    /**
     * @inheritDoc
    */
    public function withCookieParams(array $cookies): static
    {
        $this->cookies->add($cookies);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getQueryParams(): array
    {
        return $this->query->all();
    }





    /**
     * @inheritDoc
    */
    public function withQueryParams(array $query): static
    {
        $this->query->add($query);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getUploadedFiles(): array
    {
        return $this->files->all();
    }





    /**
     * @inheritDoc
    */
    public function withUploadedFiles(array $uploadedFiles): static
    {
        $this->files->add($uploadedFiles);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getParsedBody(): mixed
    {
        return $this->parsedBody->all();
    }




    /**
     * @inheritDoc
    */
    public function withParsedBody($data): static
    {
        $this->parsedBody->add($data);

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes->all();
    }





    /**
     * @inheritDoc
    */
    public function getAttribute(string $name, $default = null): mixed
    {
        return $this->attributes->get($name, $default);
    }





    /**
     * @inheritDoc
    */
    public function withAttribute(string $name, $value): static
    {
        $this->attributes->set($name, $value);

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withoutAttribute(string $name): static
    {
        $this->attributes->remove($name);

        return $this;
    }




    /**
     * @return mixed
    */
    public static function fromGlobals(): static
    {
        $server  = new ServerParams($_SERVER);
        $request = new static($server->getMethod(), $server->getUri(), $server->all());
        $request->withQueryParams($_GET)
                ->withParsedBody($_POST)
                ->withBody(new RequestBody())
                ->withHeaders($server->getHeaders()->all())
                ->withCookieParams($_COOKIE)
                ->withUploadedFiles(FileNormalizer::normalize($_FILES))
                ->withProtocolVersion($server->getProtocol()->getVersion());
        return $request;
    }
}
