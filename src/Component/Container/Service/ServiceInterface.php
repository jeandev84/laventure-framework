<?php

declare(strict_types=1);

namespace Laventure\Component\Container\Service;

/**
 * ServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Container\Service
*/
interface ServiceInterface
{
    /**
     * Returns name of service
     *
     * @return string
    */
    public function id(): string;



    /**
     * Returns value of service
     *
     * @return mixed
    */
    public function value(): mixed;




    /**
     * Set shared status
     *
     * @param bool $shared
     * @return mixed
    */
    public function share(bool $shared): mixed;





    /**
     * Determine if value shared
     *
     * @return bool
    */
    public function shared(): bool;





    /**
     * @return bool
    */
    public function callable(): bool;





    /**
     * @return bool
    */
    public function resolvable(): bool;





    /**
     * @param string $id
     *
     * @return $this
    */
    public function withId(string $id): static;





    /**
     * @param mixed $value
     *
     * @return $this
    */
    public function withValue(mixed $value): static;
}
