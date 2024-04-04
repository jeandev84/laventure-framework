<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Contract;

/**
 * HasColumnInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Contract
*/
interface HasColumnInterface
{
    /**
     * @param array $columns
     * @return $this
    */
    public function withColumns(array $columns): static;




    /**
     * Returns columns
     *
     * @return array
    */
    public function getColumns(): array;
}
