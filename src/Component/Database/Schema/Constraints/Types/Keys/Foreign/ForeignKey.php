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
 * @package  Laventure\Component\Database\Schema\Constraints\Drivers\Keys\Foreign
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
    protected string $column;




    /**
     * @var string
    */
    protected string $table;



    /**
     * @var string
    */
    protected string $references;




    /**
     * @param string $column (Example: user_id)
     * @param string|null $key
    */
    public function __construct(string $column, ?string $key = null)
    {
        parent::__construct('foreignKey', $key);
        $this->column      = $column;
        $this->constrained = new Constrained();
    }




    /**
     * @param string $column (Example: id)
     * @return $this
    */
    public function references(string $column): static
    {
        $this->references = $column;

        return $this;
    }






    /**
     * @param string $table (Example: users)
     * @return ConstrainedInterface
    */
    public function on(string $table): ConstrainedInterface
    {
        $this->table = $table;

        return $this->constrained();
    }







    /**
     * Example: onDelete('cascade'), onUpdate('cascade')
     *
     * @return ConstrainedInterface
    */
    public function constrained(): ConstrainedInterface
    {
        return $this->constrained;
    }




    /**
     * @inheritDoc
     *
     * Example: CONSTRAINT fk_products_user_id
     *          FOREIGN KEY (user_id)
     *          REFERENCES users (id)
     *          ON DELETE cascade
    */
    public function getSQL(): string
    {
        $constraint = $this->format();

        if (!$this->key) {
            return $constraint;
        }

        return sprintf('%s %s', parent::getSQL(), $constraint);
    }





    /**
     * @return string
    */
    protected function format(): string
    {
        $foreign[] = sprintf(
            'FOREIGN KEY (%s) REFERENCES %s (%s)',
            $this->column,
            $this->table,
            $this->references
        );
        $foreign[] = $this->constrained;
        return join(' ', array_filter($foreign));
    }
}
