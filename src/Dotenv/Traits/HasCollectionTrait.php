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
trait HasCollectionTrait
{
    /**
     * @var EnvironmentCollectionInterface
     */
    protected EnvironmentCollectionInterface $collection;


    /**
     * @param EnvironmentCollectionInterface $collection
     * @return $this
    */
    public function withCollection(EnvironmentCollectionInterface $collection): static
    {
        $this->collection = $collection;

        return $this;
    }


    /**
     * @return EnvironmentCollectionInterface
    */
    public function getCollection(): EnvironmentCollectionInterface
    {
        return $this->collection;
    }
}
