<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Param;

use Stringable;

/**
 * InputParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input
 */
interface InputParamInterface extends Stringable
{
    /**
     * @param $name
     * @return $this
    */
    public function name($name): static;





    /**
     * @return string
    */
    public function getName(): string;







    /**
     * @param $description
     * @return $this
    */
    public function description($description): static;




    /**
     * @return string
    */
    public function getDescription(): string;




    /**
     * @param $default
     * @return $this
    */
    public function default($default): static;





    /**
     * @return string|null
    */
    public function getDefault(): ?string;





    /**
     * @return string
    */
    public function readAsString(): string;
}
