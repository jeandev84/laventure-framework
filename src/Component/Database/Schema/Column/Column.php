<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Column\Info\ColumnInfo;
use Laventure\Component\Database\Schema\Column\Info\ColumnInfoInterface;
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
     * @var array
    */
    protected array $type = [];





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
     * @param string|null $constraint
    */
    public function __construct(string $name, string $type = '', string $constraint = null)
    {
        $this->name($name)
             ->type($type)
             ->constraint($constraint);
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
        $this->type[] = $type;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function constraint($constraints): static
    {
        return $this->option('constraint', $constraints);
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
        return $this->option('signed', true)
                    ->type('SIGNED');
    }






    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        return $this->option('signed', false)
                    ->type('UNSIGNED');
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
     * @inheritdoc
    */
    public function comments(string $comments): static
    {
        return $this->options(compact('comments'));
    }






    /**
     * @inheritdoc
    */
    public function collation(string $collation): static
    {
        return $this->options(compact('collation'));
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
        return $this->name("ADD COLUMN $this->name");
    }






    /**
     * @inheritDoc
    */
    public function rename(string $to): static
    {
        return $this->name("RENAME COLUMN $this->name TO $to");
    }






    /**
     * @inheritDoc
    */
    public function drop(): static
    {
        return $this->name("DROP COLUMN $this->name");
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
        return join(' ', $this->type);
    }




    /**
     * @inheritDoc
    */
    public function isPrimary(): bool
    {
        return $this->hasConstraint('primaryKey');
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
        $this->constraints[$constraint->getType()] = $constraint;

        return $this->option($constraint->getType(), true);
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
    public function option($id, $value): static
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
        if ($constraint = $this->getOption('constraint')) {
            return $constraint;
        }

        if (empty($this->constraints)) {
            $this->addConstraint(new NotNull());
        }

        return $this->options['constraint'] = $this->getConstraintAsString();
    }





    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(' ', array_filter([
            $this->getName(),
            $this->getType(),
            $this->getConstraint()
        ]));
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->getSQL();
    }
}
