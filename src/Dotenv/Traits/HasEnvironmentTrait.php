<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Traits;

use Laventure\Dotenv\Collection\EnvironmentCollectionInterface;

/**
 * HasEnvironmentTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Traits
 */
trait HasEnvironmentTrait
{
    /**
     * @var EnvironmentCollectionInterface
     */
    protected EnvironmentCollectionInterface $environment;


    /**
     * @param EnvironmentCollectionInterface $environment
     * @return $this
    */
    public function withEnvironments(EnvironmentCollectionInterface $environment): static
    {
        $this->environment = $environment;

        return $this;
    }


    /**
     * @return EnvironmentCollectionInterface
    */
    public function getEnvironments(): EnvironmentCollectionInterface
    {
        return $this->environment;
    }
}
