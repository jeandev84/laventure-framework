<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign;

use Laventure\Component\Database\Schema\Constraints\Contract\ConstrainedInterface;

/**
 * Constrained
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints
*/
class Constrained implements ConstrainedInterface
{
    /**
     * @var array
    */
    protected array $constrained = [];




    /**
     * @inheritDoc
    */
    public function onDelete(string $value = null): static
    {
        $this->constrained[] = sprintf('ON DELETE %s', $this->resolveValue($value));

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function onUpdate(string $value = null): static
    {
        $this->constrained[] = sprintf('ON UPDATE %s', $this->resolveValue($value));

        return $this;
    }





    /**
     * @param $value
     * @return string
    */
    private function resolveValue($value): string
    {
        return $value ? ucfirst($value) : 'SET NULL';
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return join(' ', array_values($this->constrained));
    }
}
