<?php

declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Base64\Contract;

/**
 * HasBase64FileInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Common\File\Base64\Writer
 */
interface HasBase64FileInterface
{
    /**
     * @return Base64FileInterface
    */
    public function getBase64(): Base64FileInterface;




    /**
     * @param Base64FileInterface $source
     * @return $this
    */
    public function withBase64(Base64FileInterface $source): static;
}
