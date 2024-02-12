<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Collection;

use Laventure\Contract\Parameter\ParameterInterface;

/**
 * EnvironmentCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Writer
 */
interface EnvironmentCollectionInterface extends ParameterInterface
{
    /**
     * Put some environment
     *
     * @param string $env
     * @return mixed
    */
    public function put(string $env): mixed;
}
