<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Configuration\Contract;

/**
 * NamedConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Configuration\Contract
*/
interface NamedConfigurationInterface extends ConfigurationInterface
{
    /**
     * @return string
    */
    public function getName(): string;
}
