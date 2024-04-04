<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Server\Protocol;

/**
 * ServerProtocolInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Server\Protocol
*/
interface ServerProtocolInterface
{
    /**
     * Returns protocol version name
     *
     * @return string
    */
    public function getName(): string;





    /**
     * Returns value of version
     *
     * @return string
    */
    public function getVersion(): string;
}
