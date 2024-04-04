<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Base64\Traits;

use Laventure\Component\Filesystem\File\Base64\Contract\Base64FileInterface;

/**
 * HasBase64Trait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Base64\Traits
 */
trait HasBase64Trait
{
    /**
     * @var Base64FileInterface|null
    */
    protected ?Base64FileInterface $source = null;



    /**
     * @return Base64FileInterface
    */
    public function getBase64(): Base64FileInterface
    {
        return $this->source;
    }




    /**
     * @param Base64FileInterface $source
     * @return $this
    */
    public function withBase64(Base64FileInterface $source): static
    {
        $this->source = $source;

        return $this;
    }




    /**
     * @return bool
    */
    public function hasBase64(): bool
    {
        return is_null($this->source);
    }
}
