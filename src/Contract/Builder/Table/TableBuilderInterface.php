<?php

declare(strict_types=1);

namespace Laventure\Contract\Builder\Table;

use Laventure\Contract\Builder\BuilderInterface;

/**
 * TableBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Table
 *
 * //TODO Implements add columns
 */
interface TableBuilderInterface extends BuilderInterface
{
    /**
     * Set table headers
     *
     * @param array $headers
     * @return mixed
    */
    public function addHeaders(array $headers): mixed;




    /**
     * Add header
     *
     * @param $header
     * @return mixed
    */
    public function addHeader($header): mixed;






    /**
     * Returns table headers
     *
     * @return array
    */
    public function getHeaders(): array;







    /**
     * Add empty rows
     *
     * @return $this
    */
    #public function addEmptyRows(): static;






    /**
     * Add table rows
     *
     * @return $this
    */
    public function addRows(array $rows): static;







    /**
     * Add table rows
     *
     * @param array $rows
     * @return $this
    */
    public function addRow(array $rows): static;









    /**
     * Returns headers rows
     *
     * @return array
    */
    public function getRows(): array;








    /**
     * @param $row
     * @param $column
     * @param $content
     * @return static
    */
    public function addColumn($row, $column, $content = null): static;







    /**
     * Add columns
     *
     * @param array $columns
     * @return $this
    */
    public function addColumns(array $columns): static;









    /**
     * Returns table columns
     *
     * @return array
    */
    public function getColumns(): array;
}
