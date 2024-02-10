<?php

declare(strict_types=1);

namespace Laventure\Dotenv\Traits;

use Laventure\Dotenv\Contract\EnvironmentInterface;

/**
 * HasEnvironmentsTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Dotenv\Traits
 */
trait HasEnvironmentsTrait
{
    /**
     * @var EnvironmentInterface
     */
    protected EnvironmentInterface $environment;


    /**
     * @param EnvironmentInterface $environment
     * @return $this
    */
    public function withEnvironments(EnvironmentInterface $environment): static
    {
        $this->environment = $environment;

        return $this;
    }



    /**
     * @inheritDoc
     */
    public function getEnvironments(): EnvironmentInterface
    {
        return $this->environment;
    }
}
