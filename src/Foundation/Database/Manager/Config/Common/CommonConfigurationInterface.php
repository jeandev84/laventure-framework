<?php

declare(strict_types=1);

namespace Laventure\Foundation\Database\Manager\Config\Common;

use Laventure\Contract\Parameter\ParameterInterface;

/**
 * CommonConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\Common
 */
interface CommonConfigurationInterface extends ParameterInterface
{
    /**
     * Returns current directory
     *
     * @return string
    */
    public function dir(): string;




    /**
     * Returns current namespace
     *
     * @return string
    */
    public function prefix(): string;
}
