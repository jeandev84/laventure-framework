<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Client\Request;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

/**
 * ClientRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Client\Request
*/
interface ClientRequestInterface extends RequestInterface
{
    /**
     * @return ResponseInterface
    */
    public function send(): ResponseInterface;
}
