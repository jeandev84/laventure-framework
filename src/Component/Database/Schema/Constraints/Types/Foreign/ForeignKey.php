<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Types\Foreign;

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
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers\Keys\Foreign
*/
class ForeignKey extends Constraint implements ForeignKeyInterface
{
    /**
     * @var string
    */
    protected string $column;




    /**
     * @var string
    */
    protected string $referenceTable;



    /**
     * @var string
    */
    protected string $referenceColumn;




    /**
     * @param string $column (Example: user_id)
     * @param string $key
    */
    public function __construct(string $column, string $key = '')
    {
        parent::__construct('foreignKey', $key);
        $this->column = $column;
    }




    /**
     * @inheritDoc
    */
    public function getColumn(): string
    {
        return $this->column;
    }





    /**
     * @inheritDoc
    */
    public function references(string $referenceColumn): static
    {
        $this->referenceColumn = $referenceColumn;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function on(string $referenceTable): ConstrainedInterface
    {
        $this->referenceTable = $referenceTable;

        return $this->constrained();
    }







    /**
     * Example: onDelete('cascade'), onUpdate('cascade')
     *
     * @return ConstrainedInterface
    */
    public function constrained(): ConstrainedInterface
    {
        return new Constrained($this);
    }







    /**
     * @inheritDoc
     *
     * Example: CONSTRAINT fk_products_user_id
     *          FOREIGN KEY (user_id)
     *          REFERENCES users (id)
    */
    public function getSQL(): string
    {
        $constraint =  sprintf(
            'FOREIGN KEY (%s) REFERENCES %s(%s)',
                   $this->column,
                   $this->referenceTable,
                   $this->referenceColumn
        );

        if (!$this->key) {
            return $constraint;
        }

        return sprintf('%s %s', parent::getSQL(), $constraint);
    }
}
