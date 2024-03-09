<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Param;

/**
 * InputParamInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input
 */
interface InputParamInterface
{
    /**
     * @return string
    */
    public function getName(): string;


    /**
     * @return string
    */
    public function getDescription(): string;




    /**
     * @return string|null
    */
    public function getDefault(): ?string;
}
