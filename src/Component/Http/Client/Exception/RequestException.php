<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Exception;

use Laventure\Component\Http\Message\Request\Request;
use Psr\Http\Client\RequestExceptionInterface;
use Psr\Http\Message\RequestInterface;

/**
 * RequestException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Extensions\Exception
 */
class RequestException extends ClientException implements RequestExceptionInterface
{
    /**
     * @var Request
     */
    protected RequestInterface $request;


    /**
     * @param string $message
     * @param RequestInterface $request
     * @param int $code
    */
    public function __construct(string $message, RequestInterface $request, int $code = 0)
    {
        parent::__construct($message, $code);
        $this->request = $request;
    }





    /**
     * @inheritDoc
     */
    public function getRequest(): RequestInterface
    {
        return $this->request;
    }
}
