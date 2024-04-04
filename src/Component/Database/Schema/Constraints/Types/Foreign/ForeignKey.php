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
      * @var array
     */
     protected array $constrained = [];






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
    public function on(string $referenceTable): static
    {
        $this->referenceTable = $referenceTable;

        return $this;
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
     * @inheritDoc
     *
     * Example: CONSTRAINT fk_products_user_id
     *          FOREIGN KEY (user_id)
     *          REFERENCES users (id)
     *          ON DELETE CASCADE
     *          ON UPDATE CASCADE
    */
    public function getSQL(): string
    {
        $foreignKey = $this->getForeignKey();

        if (!empty($this->constrained)) {
            return sprintf('%s %s', $foreignKey, $this->getConstrained());
        }

        return $foreignKey;
    }






    /**
     * @inheritDoc
    */
    public function getReferenceColumn(): string
    {
        return $this->referenceColumn;
    }




    /**
     * @inheritDoc
    */
    public function getReferenceTable(): string
    {
        return $this->referenceTable;
    }






    /**
     * @return string
    */
    private function getForeignKey(): string
    {
        $constraint =  sprintf(
            'FOREIGN KEY (%s) REFERENCES %s(%s)',
            $this->column,
            $this->referenceTable,
            $this->referenceColumn
        );

        if (!$this->name) {
            return $constraint;
        }

        return sprintf('%s %s', parent::getSQL(), $constraint);
    }



    /**
     * @return string
    */
    private function getConstrained(): string
    {
        return join(' ', $this->constrained);
    }





    /**
     * @param $value
     * @return string
    */
    private function resolveValue($value): string
    {
        return $value ? strtoupper($value) : 'SET NULL';
    }
}
