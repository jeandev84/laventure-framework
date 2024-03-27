<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord;


use Laventure\Component\Database\ORM\ActiveRecord\Query\QueryBuilderInterface;
use Laventure\Utils\Convertor\CamelCase\CamelCaseConvertorTrait;


/**
 * ActiveRecord
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord
*/
abstract class Model implements ActiveRecordInterface
{

    use CamelCaseConvertorTrait;



    /**
     * @var static
    */
    private static $instance;





    /**
     * @var string
    */
    protected $table = '';





    /**
     * @var string
    */
    protected $primaryKey = 'id';





    /**
     * @var null
     */
    protected $connection = null;





    /**
     * ActiveRecord attributes
     *
     * @var array
    */
    protected array $attributes = [];






    /**
     * @var array
    */
    public $save = [];





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
    public function setAttributes(array $attributes): static
    {
        foreach ($attributes as $column => $value) {
            $this->setAttribute($column, $value);
        }

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
         return [];
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
     * @return array
    */
    public function getColumns(): array
    {
        return array_keys($this->attributes);
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

    }






    /**
     * @inheritDoc
    */
    public static function query(): QueryBuilderInterface
    {

    }





    /**
     * @inheritDoc
    */
    public static function select($columns = null): QueryBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public static function where(string $column, $value, string $operator = "="): QueryBuilderInterface
    {

    }





    /**
     * @inheritDoc
    */
    public static function orderBy(string $column, string $direction = null): QueryBuilderInterface
    {

    }




    /**
     * @inheritDoc
    */
    public static function find($id): mixed
    {

    }




    /**
     * @inheritDoc
    */
    public static function all(): array
    {

    }




    /**
     * @inheritDoc
    */
    public static function create(array $attributes): int
    {

    }





    /**
     * @inheritDoc
    */
    public function update(array $attributes): int
    {

    }




    /**
     * @inheritDoc
    */
    public function save(): int
    {

    }
}
