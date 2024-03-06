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
final class Request extends ServerRequest
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
     * @return static
    */
    public static function createFromGlobals(): static
    {
        return static::fromGlobals();
    }
}
