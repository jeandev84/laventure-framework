<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Message\Request\Constract;

use Laventure\Component\Http\Message\Request\Server\ServerParamInterface;
use Laventure\Component\Http\Storage\Cookie\Jar\CookieJarInterface;
use Laventure\Component\Http\Storage\Session\HasSessionInterface;
use Psr\Http\Message\ServerRequestInterface;

/**
 * CustomRequestInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Message\Request
*/
interface CustomRequestInterface extends ServerRequestInterface, HasSessionInterface
{
    /**
     * @return ServerParamInterface
    */
    public function getServer(): ServerParamInterface;


    /**
     * @return CookieJarInterface
    */
    public function getCookieJar(): CookieJarInterface;



    /**
     * @return bool
    */
    public function hasSession(): bool;
}
