<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Contract;

use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;

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
     * @return EnvironmentCollectionInterface
    */
    public function getEnvironments(): EnvironmentCollectionInterface;
}
