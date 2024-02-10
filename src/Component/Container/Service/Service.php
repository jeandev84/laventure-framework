<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Service;

/**
 * Service
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Service
*/
class Service implements ServiceInterface
{
    /**
     * @var string
    */
    protected string $id;


    /**
     * @var mixed
    */
    protected mixed $value;



    /**
     * @var bool
    */
    protected bool $shared;



    /**
     * @param string $id
     * @param mixed $value
     * @param bool $shared
    */
    public function __construct(string $id, mixed $value, bool $shared = false)
    {
        $this->withId($id)
             ->withValue($value)
             ->share($shared);
    }





    /**
     * @inheritDoc
     */
    public function withId(string $id): static
    {
        $this->id = $id;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function withValue(mixed $value): static
    {
        $this->value = $value;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function id(): string
    {
        return $this->id;
    }




    /**
     * @inheritDoc
    */
    public function value(): mixed
    {
        return $this->value;
    }




    /**
     * @inheritDoc
    */
    public function share(bool $shared): static
    {
        $this->shared = $shared;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function shared(): bool
    {
        return $this->shared;
    }





    /**
     * @inheritDoc
    */
    public function callable(): bool
    {
        return is_callable($this->value);
    }





    /**
     * @inheritDoc
    */
    public function resolvable(): bool
    {
        return (is_string($this->value) && class_exists($this->value));
    }
}
