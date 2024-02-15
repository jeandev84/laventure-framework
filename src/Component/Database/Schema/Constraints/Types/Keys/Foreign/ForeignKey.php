<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign;

use Laventure\Component\Database\Schema\Constraints\Constraint;
use Laventure\Component\Database\Schema\Constraints\Contract\ConstrainedInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;

/**
 * ForeignKey
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Types\Keys\Foreign
*/
class ForeignKey extends Constraint implements ForeignKeyInterface
{
    /**
     * @var ConstrainedInterface
    */
    protected ConstrainedInterface $constrained;




    /**
     * @var string
    */
    protected string $table;



    /**
     * @param string $name
     * @param string|null $key
    */
    public function __construct(string $name, ?string $key = null)
    {
        parent::__construct($name, $key);
        $this->constrained = new Constrained();
    }


    /**
     * @param string $column
     * @return $this
    */
    public function references(string $column): static
    {
        $this->columns[0] = $column;

        return $this;
    }






    /**
     * @param string $table
     * @return ConstrainedInterface
    */
    public function on(string $table): ConstrainedInterface
    {
        $this->table = $table;

        return $this->constrained();
    }







    /**
     * @return ConstrainedInterface
    */
    public function constrained(): ConstrainedInterface
    {
        return $this->constrained;
    }




    /**
     * @inheritDoc
     *
     * Example: CONSTRAINT fk_products_user_id FOREIGN KEY (user_id) REFERENCES users(id) ON DELETE cascade
    */
    public function getSQL(): string
    {
        $criteria[] = sprintf('FOREIGN KEY (%s) REFERENCES %s (%s)', $this->name, $this->table, $this->columns[0]);
        $criteria[] = $this->constrained;
        $constraints = join(' ', array_filter($criteria));

        if (!$this->key) {
            return $constraints;
        }

        return sprintf('%s %s', parent::getSQL(), $constraints);
    }
}
