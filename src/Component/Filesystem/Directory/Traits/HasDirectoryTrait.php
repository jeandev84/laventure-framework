<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\Directory\Traits;

/**
 * HasDirectoryTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\Directory\Traits
*/
trait HasDirectoryTrait
{
    /**
     * @var string
    */
    protected string $directory = '';


    /**
     * @param string $directory
     * @return $this
    */
    public function setDirectory(string $directory): static
    {
        $this->directory = $directory;

        return $this;
    }



    /**
     * @return string
    */
    public function getDirectory(): string
    {
        return $this->directory;
    }
}
