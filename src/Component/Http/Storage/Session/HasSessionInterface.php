<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Storage\Session;

/**
 * HasSessionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Storage\Session
*/
interface HasSessionInterface
{
    /**
     * @param SessionInterface $session
     * @return $this
    */
    public function withSession(SessionInterface $session): mixed;




    /**
     * @return SessionInterface|null
    */
    public function getSession(): ?SessionInterface;
}
