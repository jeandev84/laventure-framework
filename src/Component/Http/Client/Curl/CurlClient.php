<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Curl;

use Laventure\Component\Http\Client\Client;
use Laventure\Component\Http\Client\Exception\NetworkException;
use Laventure\Component\Http\Client\Exception\RequestException;
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

        // Check for any request errors
        $this->checkErrorsForAnyRequest(
            $request,
            $curlRequest->errno(),
            $curlRequest->error()
        );

        return new Response(
            $curlResponse->getBody(),
            $curlResponse->getStatusCode(),
            $curlResponse->getHeaders()
        );
    }


    /**
     * @param RequestInterface $request
     * @param int $errno
     * @param string $error
     * @return void
     * @throws NetworkException
     * @throws RequestException
     */
    private function checkErrorsForAnyRequest(
        RequestInterface $request,
        int $errno,
        string $error
    ): void {
        // Check for any request errors
        switch ($errno) {
            case CURLE_OK: break;
            case CURLE_COULDNT_RESOLVE_PROXY:
            case CURLE_COULDNT_RESOLVE_HOST:
            case CURLE_COULDNT_CONNECT:
            case CURLE_OPERATION_TIMEOUTED:
            case CURLE_SSL_CONNECT_ERROR:
                throw new NetworkException($error, $request);
            default:
                throw new RequestException($error, $request);
        }
    }
}
