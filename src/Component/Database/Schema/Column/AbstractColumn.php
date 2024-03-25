<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Types\DefaultValue;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Primary\PrimaryKey;
use Laventure\Component\Database\Schema\Constraints\Types\Keys\Unique\UniqueKey;
use Laventure\Component\Database\Schema\Constraints\Types\NotNull;
use Laventure\Component\Database\Schema\Constraints\Types\Nullable;
use ReflectionException;
use ReflectionMethod;

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
     * @var mixed
    */
    protected string $type;







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
        "sign"      => "",
        "increment" => "",
        "collation" => "",
        "comments"  => ""
    ];







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
    public function string(int $length = 255): static
    {
        return $this->type("VARCHAR($length)")
                    ->options(compact('length'));
    }





    /**
     * @inheritDoc
    */
    public function boolean(): static
    {
        return $this->type("BOOLEAN");
    }





    /**
     * @inheritDoc
    */
    public function text(): static
    {
        return $this->type("TEXT");
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
            new DefaultValue(sprintf('"%s"', $value))
        );
    }







    /**
     * @inheritDoc
    */
    public function notNull(): static
    {
        return $this->constraint(new NotNull());
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
        $this->options = array_merge(
            $this->options,
            $options
        );

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
    public function add(): string
    {
        return sprintf('ADD COLUMN %s', $this->getSQL());
    }







    /**
     * @inheritDoc
    */
    public function modify(): string
    {
        return sprintf('MODIFY COLUMN %s', $this->getSQL());
    }







    /**
     * @inheritDoc
    */
    public function rename(string $to): string
    {
        return "RENAME COLUMN $this->name TO $to";
    }





    /**
     * @inheritDoc
    */
    public function drop(): string
    {
        return "DROP COLUMN $this->name";
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
            $this->notNull();
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
        return join(' ', array_filter([
            $this->getName(),
            $this->getType(),
            $this->getSign(),
            $this->getIncrement(),
            $this->getConstraint()
        ]));
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
        return $this->getSQL();
    }




    /**
     * @param string|ColumnType $type
     * @param array $options
     * @return $this
     * @throws ReflectionException
    */
    protected function parseType(string|ColumnType $type, array $options = []): static
    {
        if ($type instanceof ColumnType) {
            $method = $type->value;
            $reflection = new ReflectionMethod($this, $method);
            $parameters = $reflection->getParameters();
            dump($parameters);
            dd($reflection->getName());
        } else {
            $this->type($type);
        }


        return $this;
    }
}
