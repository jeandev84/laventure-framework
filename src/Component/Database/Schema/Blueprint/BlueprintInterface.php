<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Blueprint;

use Laventure\Component\Database\Schema\Blueprint\Column\BlueprintColumnInterface;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Table\TableInterface;

/**
 * BlueprintInterface
 *
 * @comments That is the table decorator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Blueprint
 */
interface BlueprintInterface
{
    /**
     * Add incremental column
     *
     * @param string $name
     * @return BlueprintColumnInterface
    */
    public function increments(string $name): BlueprintColumnInterface;








    /**
     * Add big increment
     *
     * @param string $name
     * @return BlueprintColumnInterface
    */
    public function bigIncrements(string $name): BlueprintColumnInterface;







    /**
     * Add integer
     *
     * @param string $name
     * @param int $length
     * @return BlueprintColumnInterface
    */
    public function integer(string $name, int $length = 11): BlueprintColumnInterface;







    /**
     * Add column type small integer
     *
     * @param string $name
     * @return BlueprintColumnInterface
    */
    public function smallInteger(string $name): BlueprintColumnInterface;







    /**
     * Add column type big integer
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function bigInteger(string $name): BlueprintColumnInterface;







    /**
     * Add column type big integer
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function mediumInteger(string $name): BlueprintColumnInterface;







    /**
     * Add column type tiny integer
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function tinyInteger(string $name): BlueprintColumnInterface;








    /**
     * Add column type string
     *
     * @param string $name
     * @param int $length
     * @return BlueprintColumnInterface
     */
    public function string(string $name, int $length = 255): BlueprintColumnInterface;






    /**
     * Add column type char
     *
     * @param string $name
     * @param $value
     * @return BlueprintColumnInterface
    */
    public function char(string $name, $value): BlueprintColumnInterface;






    /**
     * Add column type boolean
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function boolean(string $name): BlueprintColumnInterface;







    /**
     * Add column type datetime
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function datetime(string $name): BlueprintColumnInterface;









    /**
     * Add column type time
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function time(string $name): BlueprintColumnInterface;







    /**
     * Add column type timestamp
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function timestamp(string $name): BlueprintColumnInterface;







    /**
     * Add column type binary
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function binary(string $name): BlueprintColumnInterface;







    /**
     * Add column type date
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function date(string $name): BlueprintColumnInterface;








    /**
     * Add column type decimal
     *
     * @param string $name
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return BlueprintColumnInterface
     */
    public function decimal(string $name, int $precision, int $scale): BlueprintColumnInterface;









    /**
     * Add column type double
     *
     * @param string $name
     *
     * @param int $precision
     *
     * @param int $scale
     *
     * @return BlueprintColumnInterface
     */
    public function double(string $name, int $precision, int $scale): BlueprintColumnInterface;










    /**
     * Add column type enum
     *
     * @param string $name
     * @param array $values
     * @return BlueprintColumnInterface
     */
    public function enum(string $name, array $values): BlueprintColumnInterface;










    /**
     * Add column type float
     *
     * @param string $name
     * @return BlueprintColumnInterface
     */
    public function float(string $name): BlueprintColumnInterface;







    /**
     * Add column type json
     *
     * @param string $name
     * @return BlueprintColumnInterface
    */
    public function json(string $name): BlueprintColumnInterface;








    /**
     * Add column type text
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
     */
    public function text(string $name): BlueprintColumnInterface;








    /**
     * Add column type long text
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function longText(string $name): BlueprintColumnInterface;







    /**
     * Add column type medium text
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function mediumText(string $name): BlueprintColumnInterface;






    /**
     * Add column type tiny text
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function tinyText(string $name): BlueprintColumnInterface;








    /**
     * Add column type morphs
     *
     * @param string $name
     *
     * @return BlueprintColumnInterface
    */
    public function morphs(string $name): BlueprintColumnInterface;







    /**
     * Set incremental ID
     *
     * @return $this
    */
    public function id(): static;




    /**
     * Add column type default
     *
     * @param $value
     *
     * @return mixed
    */
    public function default($value): static;








    /**
     * Add unsigned column
     *
     * @return $this
    */
    public function unsigned(): static;








    /**
     * @return $this
    */
    public function timestamps(): static;







    /**
     * @return $this
    */
    public function softDeletes(): static;








    /**
     * Add Nullable timestamps
    */
    public function nullableTimestamps(): static;







    /**
     * @return $this
    */
    public function rememberToken(): static;







    /**
     * @param array $columns
     * @return static
    */
    public function primary(array $columns): static;






    /**
     * @param array $columns
     * @return $this
    */
    public function unique(array $columns): static;







    /**
     * @param array$columns
     * @return $this
    */
    public function index(array $columns): static;







    /**
     * @param string $name
     * @param callable $func
     * @return BlueprintInterface
    */
    public function foreign(string $name, callable $func): static;






    /**
     * @param callable $func
     * @return BlueprintInterface
    */
    public function foreignId(callable $func): static;
    







    /**
     * @return mixed
    */
    public function createTable(): mixed;







    /**
     * @return mixed
    */
    public function updateTable(): mixed;







    /**
     * @return mixed
    */
    public function dropTable(): mixed;






    /**
     * @return mixed
    */
    public function truncateTable(): mixed;







    /**
     * @param string $name
     * @return mixed
    */
    public function renameTable(string $name): mixed;







    /**
     * Returns columns
     *
     * @return BlueprintColumnInterface[]
    */
    public function getColumns(): array;






    /**
     * Returns table
     *
     * @return TableInterface
    */
    public function table(): TableInterface;
}
