<?php

declare(strict_types=1);

namespace Laventure\Component\Http\Message\Request\Stack;

use Psr\Http\Message\ServerRequestInterface;
use Symfony\Component\HttpFoundation\Exception\SessionNotFoundException;
use Symfony\Component\HttpFoundation\Request;

/**
 * RequestStackInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Http\Message\Request\Stack
*/
interface RequestStackInterface
{
    /**
     * Pushes a Request on the stack.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
    */
    public function pushRequest($request): mixed;






    /**
     * Pops the current request from the stack.
     *
     * This operation lets the current request go out of scope.
     *
     * This method should generally not be called directly as the stack
     * management should be taken care of by the application itself.
     *
     * @return mixed
    */
    public function pop(): mixed;





    /**
     * Gets the main request.
     *
     * Be warned that making your code aware of the main request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
     * @return mixed
    */
    public function getCurrentRequest(): mixed;






    /**
     * Gets the main request.
     *
     * Be warned that making your code aware of the main request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
     * @return mixed
    */
    public function getMainRequest(): mixed;





    /**
     * Returns the parent request of the current.
     *
     * Be warned that making your code aware of the parent request
     * might make it un-compatible with other features of your framework
     * like ESI support.
     *
     * If current Request is the main request, it returns null.
     *
     * @return mixed
    */
    public function getParentRequest(): mixed;








    /**
     * Gets the current session.
     *
     * @return mixed
    */
    public function getSession(): mixed;
}
