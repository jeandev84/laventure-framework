<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Query\Builder\SQL\Conditions\Where;

/**
 * WhereBuilderInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Contract
*/
interface WhereInterface
{
    /**
     * Add WHERE conditions
     *
     * @param string $condition
     *
     * @return $this
    */
    public function where(string $condition): static;





    /**
     * Add WHERE conditions AND
     *
     * @param string $condition
     *
     * @return $this
    */
    public function andWhere(string $condition): static;







    /**
     * Add WHERE conditions OR
     *
     * @param string $condition
     *
     * @return $this
    */
    public function orWhere(string $condition): static;








    /**
     * Add WHERE conditions BY criteria
     *
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static;







    /**
     * Returns conditions
     *
     * @return array
    */
    public function getWheres(): array;
}
