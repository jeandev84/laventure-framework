<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Curl;

use Laventure\Component\Http\Client\Client;
use Laventure\Component\Http\Message\Response\Response;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * CurlClient
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Curl
*/
class CurlClient extends Client
{

    /**
     * @inheritDoc
    */
    public function sendRequest(RequestInterface $request): ResponseInterface
    {
        $uri     = $request->getUri();
        $uri->withQuery($this->getOption('query', []));

        $curlRequest  = new CurlRequest(strval($uri), $request->getMethod());
        $curlRequest->options($this->options);
        $curlResponse = $curlRequest->send();

        $response = new Response(
            $curlResponse->getStatusCode(),
            $curlResponse->getHeaders()
        );

        $response->getBody()->write($curlResponse->getBody());

        return $response;
    }
}
