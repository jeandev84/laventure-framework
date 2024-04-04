<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Output\Table;

use Laventure\Contract\Builder\Table\TableBuilderInterface;

/**
 * ConsoleTableInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Table
*/
interface ConsoleTableInterface extends TableBuilderInterface
{
    /**
     * @param int $padding
     * @return $this
     */
    public function addPadding(int $padding = 1): static;







    /**
     * @param int $indent
     * @return $this
    */
    public function addIndent(int $indent = 0): static;








    /**
     * Add borderline
     *
     * @return $this
    */
    public function addBorderLine(): static;






    /**
     * Returns border line
     *
     * @return mixed
    */
    public function getBorderLine(): string;






    /**
     * Hide table border
     *
     * @return $this
    */
    public function hideBorder(): static;









    /**
     * Show border
     *
     * @return $this
    */
    public function showBorder(): static;









    /**
     * Show all orders
     *
     * @return $this
    */
    public function showAllBorders(): static;





    /**
     * Display built table after building
     *
     * @return void
    */
    public function display(): void;
}
