<?php

declare(strict_types=1);

namespace Laventure\Traits\Application;

/**
 * ApplicationTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Traits\Application
*/
trait ApplicationTrait
{
    /**
     * @var string
    */
    protected string $name;


    /**
     * @var string
    */
    protected string $version;




    /**
     * @param string $name
     *
     * @return $this
     */
    public function name(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getName(): ?string
    {
        return $this->name;
    }




    /**
     * @param string $version
     *
     * @return $this
    */
    public function version(string $version): static
    {
        $this->version = $version;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function getVersion(): ?string
    {
        return $this->version;
    }
}
