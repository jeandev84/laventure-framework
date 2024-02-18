<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Traits\HasConstraintTrait;
use Laventure\Component\Database\Schema\Constraints\Types\DefaultValue;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\NotNull;
use Laventure\Component\Database\Schema\Constraints\Types\Nullable;
use Laventure\Component\Database\Schema\Constraints\Types\Unique;
use Laventure\Traits\Options\HasOptionsTrait;

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

    use HasOptionsTrait;
    use HasConstraintTrait;



    protected const DEFAULT_OPTIONS = [
        'signed'      => false,
        'constraint'  => null,
        'comments'    => null,
        'collation'   => null
    ];




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
     * @param string $name
     * @param string $type
     * @param string|null $constraint
    */
    public function __construct(string $name, string $type = '', string $constraint = null)
    {
        $this->name($name)
             ->type($type)
             ->constraint($constraint)
             ->withOptions(static::DEFAULT_OPTIONS);
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
        return $this->withConstraint(new PrimaryKey());
    }





    /**
     * @inheritDoc
    */
    public function unique(): static
    {
        return $this->withConstraint(new Unique());
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
        return $this->withConstraint(new Nullable());
    }





    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        return $this->withConstraint(new DefaultValue($value, true));
    }





    /**
     * @inheritdoc
    */
    public function comments(string $comments): static
    {
        return $this->withOptions(compact('comments'));
    }






    /**
     * @inheritdoc
    */
    public function collation(string $collation): static
    {
        return $this->withOptions(compact('collation'));
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
     * @inheritdoc
    */
    public function withConstraint(ConstraintInterface $constraint): static
    {
        $this->constraints[$constraint->getType()] = $constraint;

        return $this->option($constraint->getType(), true);
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
     * @return string
    */
    public function getConstraint(): string
    {
        if ($constraint = $this->getOption('constraint')) {
            return $constraint;
        }

        if (empty($this->constraints)) {
            $this->withConstraint(new NotNull());
        }

        return $this->options['constraint'] = $this->getConstraintsAsString();
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
