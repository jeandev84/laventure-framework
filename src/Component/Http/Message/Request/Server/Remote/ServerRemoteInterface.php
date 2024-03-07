<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server\Remote;

/**
 * ServerRemoteInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Server\Remote
*/
interface ServerRemoteInterface
{
    /**
     * Returns remote address
     *
     * @return string
    */
    public function getAddress(): string;






    /**
     * Returns remote address port
     *
     * @return int
    */
    public function getPort(): int;








    /**
     * Returns remote IP
     *
     * @return int
    */
    public function getIp(): int;
}
