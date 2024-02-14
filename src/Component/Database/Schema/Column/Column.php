<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Types\DefaultValue;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\NotNull;
use Laventure\Component\Database\Schema\Constraints\Types\Nullable;
use Laventure\Component\Database\Schema\Constraints\Types\Unique;

/**
 * Column
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table\Column
*/
abstract class Column implements ColumnInterface
{
    /**
     * Column name
     *
     * @var string
    */
    protected string $name;




    /**
     * Column data type
     *
     * @var string
    */
    protected string $type;




    /**
     * @var ConstraintInterface[]
    */
    protected array $constraints = [];




    /**
     * @var array|null[]
    */
    protected array $options = [
        'signed'      => false,
        'constraint'  => null,
        'comments'    => null,
        'collation'   => null
    ];






    /**
     * @param string $name
     * @param string $type
    */
    public function __construct(string $name, string $type)
    {
        $this->name($name)
             ->type($type)
             ->addConstraint(new NotNull());
    }



    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @param string $type
     * @return $this
    */
    public function type(string $type): static
    {
        $this->type = $type;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function constraint(string $constraints): static
    {
        return $this->setOption('constraint', $constraints);
    }





    /**
     * @inheritDoc
    */
    public function primary(): static
    {
        return $this->addConstraint(new PrimaryKey());
    }





    /**
     * @inheritDoc
    */
    public function unique(): static
    {
        return $this->addConstraint(new Unique());
    }







    /**
     * @inheritDoc
    */
    public function signed(): static
    {
       return $this->setOption('signed', true);
    }






    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        return $this->setOption('signed', false);
    }




    /**
     * @inheritDoc
    */
    public function nullable(): static
    {
        return $this->addConstraint(new Nullable());
    }





    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        return $this->addConstraint(new DefaultValue($value, true));
    }





    /**
     * @inheritDoc
    */
    public function options(array $options): static
    {
        $this->options = array_merge($this->options, $options);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function add(): static
    {

    }




    /**
     * @inheritDoc
    */
    public function modify(): static
    {

    }




    /**
     * @inheritDoc
    */
    public function rename(string $to): static
    {

    }




    /**
     * @inheritDoc
    */
    public function drop(): static
    {

    }


    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @inheritDoc
    */
    public function getType(): string
    {
        return $this->type;
    }




    /**
     * @inheritDoc
    */
    public function isPrimary(): bool
    {
        return $this->hasConstraint('primaryKey');
    }






    /**
     * @inheritdoc
    */
    public function isUnique(): bool
    {
        return $this->hasConstraint('unique');
    }






    /**
     * @inheritDoc
    */
    public function isSigned(): bool
    {
       return $this->getOption('signed');
    }







    /**
     * @inheritDoc
     */
    public function addConstraints(array $constraints): static
    {
        foreach ($constraints as $constraint) {
            $this->addConstraint($constraint);
        }

        return $this;
    }




    /**
     * @inheritdoc
     */
    public function addConstraint(ConstraintInterface $constraint): static
    {
        $this->constraints[$constraint->getName()] = $constraint;

        return $this->setOption('constraint', $constraint->getSQL());
    }





    /**
     * @inheritDoc
     */
    public function hasConstraint(string $name): bool
    {
        return isset($this->constraints[$name]);
    }







    /**
     * @inheritDoc
    */
    public function getConstraints(): array
    {
        return $this->constraints;
    }






    /**
     * @inheritDoc
    */
    public function getComments(): string
    {
        return $this->getOption('comments');
    }





    /**
     * @inheritDoc
    */
    public function getCollation(): string
    {
        return $this->getOption('collation');
    }




    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
        return $this->options;
    }




    /**
     * @param $id
     * @param $value
     * @return $this
    */
    public function setOption($id, $value): static
    {
        $this->options[$id] = $value;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function getOption($id, $default = null): mixed
    {
        return $this->options[$id] ?? $default;
    }




    /**
     * @return string
    */
    public function getConstraintAsString(): string
    {
         $func = function (ConstraintInterface $constraint) {
             return $constraint->getSQL();
         };

         $constraints = array_filter($this->getConstraints(), $func);

         return join(' ', $constraints);
    }






    /**
     * @return string
    */
    public function getConstraint(): string
    {
        return $this->getOption('constraint');
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(' ', [
           $this->getName(),
           $this->getType(),
           $this->getConstraint()
        ]);
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }
}
