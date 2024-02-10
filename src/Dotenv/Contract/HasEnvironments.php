<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Contract;

/**
 * HasEnvironments
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Writer
 */
interface HasEnvironments
{
    /**
     * @return EnvironmentInterface
    */
    public function getEnvironments(): EnvironmentInterface;
}
