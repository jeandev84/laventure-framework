<?php

declare(strict_types=1);

namespace Laventure\Foundation\Http\Message\Request;

use Laventure\Component\Http\Message\Request\Stack\RequestStackInterface;
use Laventure\Component\Http\Storage\Session\Exception\SessionNotFoundException;

/**
 * RequestStack
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Http\Message\Request
*/
class RequestStack implements RequestStackInterface
{
    /**
     * @var Request[]
    */
    protected array $requests = [];




    /**
     * @inheritDoc
    */
    public function pushRequest($request): static
    {
        return $this->push($request);
    }




    /**
     * @param Request $request
     * @return $this
    */
    public function push(Request $request): static
    {
        $this->requests[] = $request;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function pop(): ?Request
    {
        if (!$this->requests) {
            return null;
        }

        return array_pop($this->requests);
    }




    /**
     * @inheritDoc
    */
    public function getCurrentRequest(): ?Request
    {
        return end($this->requests) ?: null;
    }




    /**
     * @inheritDoc
    */
    public function getMainRequest(): ?Request
    {
        if (!$this->requests) {
            return null;
        }

        return $this->requests[0];
    }




    /**
     * @inheritDoc
    */
    public function getParentRequest(): ?Request
    {
        $pos = \count($this->requests) - 2;

        return $this->requests[$pos] ?? null;
    }




    /**
     * @inheritDoc
    */
    public function getSession(): mixed
    {
        if ((null !== $request = end($this->requests) ?: null) && $request->hasSession()) {
            return $request->getSession();
        }

        throw new SessionNotFoundException();
    }
}
