<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Cookie;

use Laventure\Component\Http\Storage\Cookie\Params\CookieParamsInterface;

/**
 * CookieInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\ClientCookie
 *
 * @see https://www.php.net/manual/en/function.setcookie.php
*/
interface CookieInterface
{
    /**
     * @param CookieParamsInterface $dto
    */
    public function __construct(CookieParamsInterface $dto);




    /**
     * @return CookieParamsInterface
    */
    public function getParams(): CookieParamsInterface;
}
