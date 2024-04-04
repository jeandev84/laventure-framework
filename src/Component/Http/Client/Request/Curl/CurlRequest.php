<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request\Curl;

use Laventure\Component\Http\Client\Request\ClientRequestInterface;
use Laventure\Component\Http\Message\Request\Request;
use Psr\Http\Message\ResponseInterface;

/**
 * CurlRequest
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request\Curl
*/
class CurlRequest extends Request implements ClientRequestInterface
{
    /**
     * @inheritDoc
    */
    public function send(): ResponseInterface
    {

    }
}
