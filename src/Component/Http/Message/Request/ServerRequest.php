<?php
declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request;

use Laventure\Component\Http\Message\Request\Body\RequestBody;
use Laventure\Component\Http\Message\Request\Utils\Normalizer\FileNormalizer;
use Laventure\Component\Http\Message\Request\Utils\Params\ServerParams;
use Laventure\Foundation\Http\Message\Request\Bag\InputBag;
use Laventure\Foundation\Http\Message\Request\Bag\ParameterBag;
use Laventure\Foundation\Http\Message\Request\Bag\ServerBag;
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
        $this->uploadedFiles = array_merge(
            $this->uploadedFiles,
            $uploadedFiles
        );

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getParsedBody(): mixed
    {
        return $this->parsedBody;
    }




    /**
     * @inheritDoc
    */
    public function withParsedBody($data): static
    {
        $this->parsedBody = $data;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }





    /**
     * @inheritDoc
    */
    public function getAttribute(string $name, $default = null): mixed
    {
        return $this->attributes[$name] ?? $default;
    }





    /**
     * @inheritDoc
    */
    public function withAttribute(string $name, $value): static
    {
        $this->attributes[$name] = $value;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withoutAttribute(string $name): static
    {
        unset($this->attributes[$name]);

        return $this;
    }




    /**
     * @return static
    */
    public static function fromGlobals(): static
    {
        $server  = new ServerParams($_SERVER);
        $request = new self($server->getMethod(), $server->getUri(), $server->all());
        $request->withQueryParams($_GET)
                ->withParsedBody($_POST)
                ->withBody(new RequestBody())
                ->withHeaders($server->getHeaders())
                ->withCookieParams($_COOKIE)
                ->withUploadedFiles(FileNormalizer::normalize($_FILES))
                ->withProtocolVersion($server->getVersion());
        return $request;
    }
}
