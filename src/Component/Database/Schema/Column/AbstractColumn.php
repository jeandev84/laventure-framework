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


/**
 * AbstractColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column
*/
abstract class AbstractColumn implements ColumnInterface
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
     * @var string
    */
    protected string $sql = '';






    /**
     * Column constraints
     *
     * @var array
    */
    protected array $constraints = [];




    /**
     * Column options
     *
     * @var array
    */
    protected array $options = [
        "primary"   => false,
        "unique"    => false,
        "nullable"  => false,
        "default"   => null,
        "sign"      => "",
        "increment" => "",
        "collation" => "",
        "comments"  => ""
    ];






    /**
     * @param string $name
     * @param string $type
     * @param array $options
    */
    public function __construct(string $name, string $type = '', array $options = [])
    {
        $this->name($name)
            ->type($type)
            ->options($options);
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
     * @inheritDoc
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
        return $this->constraint(new DefaultValue($value, [
            $this->notNull()
        ]));
    }








    /**
     * @inheritDoc
    */
    public function nullable(): static
    {
        return $this->constraint(new Nullable());
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
     * @inheritDoc
    */
    public function comments(string $comments): static
    {
        return $this->options(compact('comments'));
    }








    /**
     * @inheritDoc
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
        foreach ($options as $name => $value) {
            if (method_exists($this, $name)) {
                call_user_func([$this, $name], $value);
            }
            $this->option($name, $value);
        }

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function hasOption(string $name): bool
    {
        return array_key_exists($name, $this->options);
    }







    /**
     * @inheritDoc
    */
    public function option($id, $value): static
    {
       $this->options[$id] = $value;

       return $this;
    }







    /**
     * @inheritDoc
    */
    public function add(): static
    {
        return $this->withSQL(
            sprintf('ADD COLUMN %s', $this->readAsString())
        );
    }







    /**
     * @inheritDoc
    */
    public function modify(): static
    {
        return $this->withSQL(
            sprintf('MODIFY COLUMN %s', $this->readAsString())
        );
    }







    /**
     * @inheritDoc
    */
    public function rename(string $to): static
    {
        return $this->withSQL("RENAME COLUMN $this->name TO $to");
    }





    /**
     * @inheritDoc
    */
    public function drop(): static
    {
        return $this->withSQL("DROP COLUMN $this->name");
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
        return $this->getOption('sign');
    }






    /**
     * @inheritDoc
     */
    public function getConstraint(): string
    {
        if (empty($this->constraints)) {
           $this->constraints($this->notNull()->getSQL());
        }

        return join(' ', $this->constraints);
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
        if ($this->sql) {
            return $this->sql;
        }

        return $this->__toString();
    }






    /**
     * @param string $sql
     * @return $this
    */
    public function withSQL(string $sql): static
    {
        $this->sql = $sql;

        return $this;
    }






    /**
     * @param $sign
     * @return $this
    */
    public function withSign($sign): static
    {
        return $this->options(compact('sign'));
    }





    /**
     * @param $increment
     * @return $this
    */
    public function whereIncrement($increment): static
    {
        return $this->options(compact('increment'));
    }





    /**
     * @return string|null
    */
    public function getIncrement(): ?string
    {
        return $this->getOption('increment');
    }






    /**
     * @inheritDoc
    */
    public function __toString(): string
    {
        return $this->readAsString();
    }






    /**
     * @return NotNull
    */
    protected function notNull(): NotNull
    {
        return new NotNull();
    }






    /**
     * @return string
    */
    protected function readAsString(): string
    {
        return join(' ', array_filter([
            $this->getName(),
            $this->getType(),
            $this->getSign(),
            $this->getIncrement(),
            $this->getConstraint()
        ]));
    }
}