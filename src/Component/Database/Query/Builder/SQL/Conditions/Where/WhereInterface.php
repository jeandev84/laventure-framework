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
     * @param string $condition
     *
     * @return $this
    */
    public function where(string $condition): static;





    /**
     * @param string $condition
     *
     * @return $this
    */
    public function andWhere(string $condition): static;







    /**
     * @param string $condition
     *
     * @return $this
    */
    public function orWhere(string $condition): static;








    /**
     * @return array
    */
    public function getWheres(): array;
}
