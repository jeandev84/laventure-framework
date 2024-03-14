<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Traits;

/**
 * HasFileTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Traits
 */
trait HasFileTrait
{
    /**
     * @var string
    */
    protected string $file = '';



    /**
     * @var mixed|null
    */
    protected mixed $context = null;


    /**
     * @param string $file
     * @return $this
    */
    public function setFile(string $file): static
    {
        $this->file = $file;

        return $this;
    }




    /**
     * @return string
    */
    public function getFile(): string
    {
        return $this->file;
    }




    /**
     * @return bool
    */
    public function hasFile(): bool
    {
        return $this->file !== '';
    }



    /**
     * @return bool
    */
    public function hasContext(): bool
    {
        return !is_null($this->context);
    }





    /**
     * @param mixed $context
     * @return $this
    */
    public function context(mixed $context): static
    {
        $this->context = $context;

        return $this;
    }





    /**
     * @return mixed
    */
    public function getContext(): mixed
    {
        return $this->context;
    }
}
