<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Types\DefaultValue;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Unique\UniqueKey;
use Laventure\Component\Database\Schema\Constraints\Types\NotNull;
use Laventure\Component\Database\Schema\Constraints\Types\Nullable;
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
class Column implements ColumnInterface
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
     * Column type sign
     *
     * @var string
    */
    protected string $sign = '';






    /**
     * Column constraints
     *
     * @var array
    */
    protected array $constraints = [];






    /**
     * Column comments
     *
     * @var string
    */
    protected string $comments = '';






    /**
     * Column collation
     *
     * @var string
    */
    protected string $collation = '';





    /**
     * Column options
     *
     * @var array
    */
    protected array $options = [];






    /**
     * @param string $name
     * @param string $type
    */
    public function __construct(string $name, string $type = '')
    {
          $this->name($name)->type($type);
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
    public function constraints(string $constraints): static
    {
         $this->constraints[] = $constraints;

         return $this;
    }







    /**
     * @inheritDoc
    */
    public function primary(): static
    {
        return $this->constraint(new PrimaryKey());
    }







    /**
     * @inheritDoc
    */
    public function unique(): static
    {
        return $this->constraint(new UniqueKey());
    }







    /**
     * @inheritDoc
    */
    public function default($value): static
    {
        return $this->constraint(
            new DefaultValue($value, true)
        );
    }








    /**
     * @inheritDoc
    */
    public function nullable(): static
    {
        return $this->constraint(new Nullable());
    }







    /**
     * @inheritDoc
    */
    public function signed(): static
    {
        return $this->sign('SIGNED');
    }








    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        return $this->sign('UNSIGNED');
    }








    /**
     * @param ConstraintInterface $constraint
     * @return $this
    */
    public function constraint(ConstraintInterface $constraint): static
    {
        return $this->constraints(strval($constraint));
    }







    /**
     * @param $sign
     * @return $this
    */
    public function sign($sign): static
    {
        $this->sign = $sign;

        return $this;
    }









    /**
     * @inheritDoc
    */
    public function comments(string $comments): static
    {
        $this->comments = $comments;

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function collation(string $collation): static
    {
        $this->collation = $collation;

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function options(array $options): static
    {
        $this->options = array_merge(
            $this->options,
            $options
        );

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function option($id, $value): static
    {
        return $this->options([$id => $value]);
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
    public function getSign(): string
    {
        return $this->sign;
    }






    /**
     * @inheritDoc
    */
    public function getConstraint(): string
    {
        if (empty($this->constraints)) {
            $this->constraint(new NotNull());
        }

        return join(' ', $this->constraints);
    }







    /**
     * @inheritDoc
    */
    public function getComments(): string
    {
         return $this->comments;
    }







    /**
     * @inheritDoc
    */
    public function getCollation(): string
    {
        return $this->collation;
    }










    /**
     * @inheritDoc
    */
    public function getOptions(): array
    {
         return $this->options;
    }






    /**
     * @inheritDoc
    */
    public function getOption($key, $default = null): mixed
    {
        return $this->options[$key] ?? $default;
    }









    /**
     * @inheritDoc
    */
    public function getSQL(): string
    {
        return join(' ', array_filter([
            $this->getName(),
            $this->getType(),
            $this->getSign(),
            $this->getConstraint()
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
