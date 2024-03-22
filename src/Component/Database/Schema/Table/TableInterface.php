<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Table;

use Laventure\Component\Database\Query\QueryInterface;
use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;
use Laventure\Component\Database\Schema\Constraints\ConstraintInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\ForeignKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\IndexInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\PrimaryKeyInterface;
use Laventure\Component\Database\Schema\Constraints\Contract\UniqueInterface;
use Laventure\Component\Database\Schema\Table\Criteria\TableCriteriaInterface;

/**
 * TableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Table
*/
interface TableInterface
{
    /**
     * Add new column
     *
     * @param string $name
     * @param string $type
     * @param array $options
     * @return $this
    */
    public function addColumn(string $name, string $type, array $options = []): static;






    /**
     * Rename existent column
     *
     * @param string $name
     * @param string $to
     * @return $this
    */
    public function renameColumn(string $name, string $to): static;







    /**
     * Modify column
     *
     * @param string $name
     * @return $this
    */
    public function modifyColumn(string $name): static;








    /**
     * Drop column
     *
     * @param string $name
     *
     * @return $this
    */
    public function dropColumn(string $name): static;









    /**
     * Create a new table
     *
     * @return mixed
    */
    public function create(): mixed;








    /**
     * Update table
     *
     * @return mixed
    */
    public function update(): mixed;








    /**
     * Drop table
     *
     * @return mixed
    */
    public function drop(): mixed;








    /**
     * Drop table if exists
     *
     * @return mixed
    */
    public function dropIfExists(): mixed;








    /**
     * Truncate table
     *
     * @return mixed
    */
    public function truncate(): mixed;
}
