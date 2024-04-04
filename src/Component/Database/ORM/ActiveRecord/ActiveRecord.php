<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord;

use Laventure\Component\Database\ORM\ActiveRecord\Contract\ActiveRecordInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\ActiveRecordException;
use Laventure\Component\Database\ORM\ActiveRecord\Exception\UpdateRecordException;
use Laventure\Component\Database\ORM\ActiveRecord\Query\QueryBuilder;
use Laventure\Component\Database\ORM\ActiveRecord\Query\Builder;
use Laventure\Component\Database\ORM\ActiveRecord\Traits\SoftDeletes;
use Laventure\Component\Database\ORM\ActiveRecord\Traits\Timestamps;
use Laventure\Component\Database\ORM\Common\Collection\Collection;
use Laventure\Component\Database\Query\Builder\SQL\Expr\ExpressionBuilderInterface;
use Laventure\Utils\Convertor\CamelCase\CamelCaseConvertorTrait;

/**
 * ActiveRecord
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord
 *
 * @method static QueryBuilder select(string ...$columns)
 * @method static QueryBuilder where(string $condition)
 * @method static QueryBuilder criteria(array $criteria)
 * @method static QueryBuilder orderBy(string $column, string $direction = null)
 * @method static QueryBuilder paginate(int $page, int $limit)
*/
abstract class ActiveRecord implements ActiveRecordInterface
{
    use CamelCaseConvertorTrait;
    use Timestamps;
    use SoftDeletes;


    /**
     * @var static
     */
    private static $instance;





    /**
     * @var string
     */
    protected $table = null;





    /**
     * @var string
     */
    protected $primaryKey = 'id';




    /**
     * ActiveRecord attributes
     *
     * @var array
     */
    protected array $attributes = [];






    /**
     * @var array
    */
    protected $fill = [];





    /**
     * @var array
     */
    protected $guard = ['id'];





    /**
     * @var array
     */
    protected $hidden = [];






    /**
     * @inheritDoc
     */
    public function setAttribute(string $column, $value): static
    {
        $name = $this->camelCaseToUnderscore($column);

        $this->attributes[$name] = $value;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function getAttribute(string $column, $default = null): mixed
    {
        return $this->attributes[$column] ?? $default;
    }








    /**
     * @inheritDoc
     */
    public function hasAttribute(string $column): bool
    {
        return isset($this->attributes[$column]);
    }








    /**
     * @inheritDoc
     */
    public function removeAttribute(string $column): static
    {
        unset($this->attributes[$column]);

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function removeAttributes(): static
    {
        array_map(function (string $column) {
            $this->removeAttribute($column);
        }, $this->getColumns());

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function getAttributes(): array
    {
        return $this->attributes;
    }







    /**
     * @inheritDoc
    */
    public function getAttributesToSave(): array
    {
        $columns = $this->keep($this->getColumns());

        return $this->guard($columns);
    }






    /**
     * @inheritDoc
     */
    public function getGuardedAttributes(): array
    {
        return $this->guard;
    }






    /**
     * @inheritDoc
    */
    public function getHiddenAttributes(): array
    {
        return $this->hidden;
    }





    /**
     * @inheritDoc
    */
    public function getId(): int
    {
        return $this->getAttribute($this->primaryKey, 0);
    }




    /**
     * @inheritDoc
    */
    public function getPrimaryKey(): string
    {
        return $this->primaryKey;
    }





    /**
     * @return array
    */
    public function getColumns(): array
    {
        return $this->getConnection()
                    ->table($this->getTableName())
                    ->getColumnNames();
    }







    /**
     * @inheritDoc
     */
    public function getClassName(): string
    {
        return get_called_class();
    }







    /**
     * @inheritDoc
    */
    public function getTableName(): string
    {
        return $this->table;
    }






    /**
     * @param $field
     * @param $value
    */
    public function __set($field, $value)
    {
        $this->setAttribute($field, $value);
    }






    /**
     * @param $field
     * @return mixed
    */
    public function __get($field)
    {
        return $this->getAttribute($field);
    }





    /**
     * @inheritDoc
     */
    public function offsetExists(mixed $offset): bool
    {
        return $this->hasAttribute($offset);
    }




    /**
     * @inheritDoc
     */
    public function offsetGet(mixed $offset): mixed
    {
        return $this->getAttribute($offset);
    }






    /**
     * @inheritDoc
     */
    public function offsetSet(mixed $offset, mixed $value): void
    {
        $this->setAttribute($offset, $value);
    }





    /**
     * @inheritDoc
     */
    public function offsetUnset(mixed $offset): void
    {
        $this->removeAttribute($offset);
    }






    /**
     * @inheritDoc
     */
    public function jsonSerialize(): mixed
    {
        foreach ($this->hidden as $column) {
            if ($this->hasAttribute($column)) {
                $this->removeAttribute($column);
            }
        }

        return $this->attributes;
    }





    /**
     * @inheritDoc
    */
    public function fill(array $attributes): static
    {
        foreach ($attributes as $column => $value) {
            $this->setAttribute($column, $value);
        }

        return $this;
    }




    /**
     * @inheritDoc
    */
    public static function find($id): mixed
    {
        return static::query()->find($id);
    }





    /**
     * @inheritDoc
    */
    public static function all(): array
    {
        return self::query()->all();
    }






    /**
     * @inheritDoc
    */
    public static function create(array $attributes): int
    {
        return static::query()->create($attributes);
    }








    /**
     * @return Collection
    */
    public static function collection(): Collection
    {
        return new Collection(static::all());
    }






    /**
     * @inheritDoc
    */
    public function update(array $attributes): int
    {
        $status = static::query()->criteria($this->criteria())
                                 ->update($attributes);

        if (!$status) {
            throw new UpdateRecordException($this);
        }

        $this->fill($attributes);

        return $this->getId();
    }








    /**
     * @inheritDoc
    */
    public function delete(): bool
    {
        return static::query()->criteria($this->criteria())->delete();
    }





    /**
     * @inheritDoc
    */
    public function save(): int
    {
        $attributes = $this->getAttributesToSave();

        if ($this->getId()) {
            return $this->update($attributes);
        } else {
            return self::create($attributes);
        }
    }







    /**
     * @return ExpressionBuilderInterface
    */
    public function expr(): ExpressionBuilderInterface
    {
        return static::query()->expr();
    }







    /**
     * @inheritDoc
    */
    public static function query(): Builder
    {
        return new QueryBuilder(self::getInstance());
    }








    /**
     * @inheritDoc
    */
    public static function __callStatic(string $name, array $arguments)
    {
        $query = static::query();

        if (!method_exists($query, $name)) {
            throw new ActiveRecordException("Could not call method '$name' statically.");
        }

        return call_user_func_array([$query, $name], $arguments);
    }






    /**
     * @return static
    */
    private static function getInstance(): static
    {
        if (!self::$instance) {
            self::$instance = new static();
        }

        return self::$instance;
    }





    /**
     * @return array<string, int>
    */
    private function criteria(): array
    {
        return [$this->getPrimaryKey() => $this->getId()];
    }





    /**
     * @param array $columns
     * @return array
    */
    private function keep(array $columns): array
    {
        $attributes = [];

        foreach ($columns as $column) {
            if (!empty($this->fill)) {
                if (in_array($column, $this->fill)) {
                    $attributes[$column] = $this->getAttribute($column);
                }
            } else {
                $attributes[$column] = $this->getAttribute($column);
            }
        }

        return $attributes;
    }






    /**
     * @param array $columns
     * @return array
    */
    private function guard(array $columns): array
    {
        if (!empty($this->guard)) {
            foreach ($this->guard as $guarded) {
                if (isset($columns[$guarded])) {
                    unset($columns[$guarded]);
                }
            }
        }

        return $columns;
    }
}
