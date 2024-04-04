<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Entity\ValueObject;

/**
 * UserEmail
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity\User\ValueObject
 */
class UserEmail
{
    protected string $value;

    public function __construct(string $value)
    {
        $this->value = $value;
    }


    /**
     * @return string
    */
    public function getValue(): string
    {
        return $this->value;
    }
}
