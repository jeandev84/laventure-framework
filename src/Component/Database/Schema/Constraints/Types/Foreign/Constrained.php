<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Foreign;

use Laventure\Component\Database\Schema\Constraints\Contract\ConstrainedInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;

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
     * @param ForeignKeyInterface $foreignKey
    */
    public function __construct(protected ForeignKeyInterface $foreignKey)
    {
    }





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
        return $value ? strtoupper($value) : 'SET NULL';
    }





    /**
     *  Example: CONSTRAINT fk_products_user_id
     *           FOREIGN KEY (user_id)
     *           REFERENCES users (id)
     *           ON DELETE cascade
     *
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(' ', array_filter([
            $this->foreignKey->getSQL(),
            array_values($this->constrained)
        ]));
    }




    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->getSQL();
    }
}
