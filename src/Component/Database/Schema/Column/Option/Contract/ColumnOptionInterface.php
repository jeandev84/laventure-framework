<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Column\Option\Contract;

use Laventure\Component\Database\Schema\Column\Contract\ColumnInterface;

/**
 * ColumnOptionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Option\Contract
 */
interface ColumnOptionInterface
{
    /**
     * @return $this
    */
    public function primary(): static;




    /**
     * @return $this
    */
    public function increment(): static;





    /**
     * @return $this
    */
    public function unique(): static;





    /**
     * @return $this
    */
    public function nullable(): static;






    /**
     * @param $value
     * @return $this
    */
    public function default($value): static;






    /**
     * @param int $length
     * @return $this
    */
    public function length(int $length): static;







    /**
     * @return $this
    */
    public function notNull(): static;






    /**
     * Set function arguments
     *
     * @param array $arguments
     * @return $this
    */
    public function arguments(array $arguments): static;







    /**
     * Set options from callback
     * 
     * @param callable $func
     * @return $this
    */
    public function call(callable $func): static;

    
    
    
    

    /**
     * Set options from method
     * 
     * @param string $method
     * @return $this
    */
    public function callMethod(string $method): static;




    
    


    /**
     * Returns function arguments
     *
     * @return array
    */
    public function getArguments(): array;








    /**
     * @return ColumnInterface
    */
    public function getColumn(): ColumnInterface;
}
