<?php

declare(strict_types=1);

namespace Laventure\Foundation\Generator\Stub;

use Laventure\Component\Filesystem\File\Generator\FileGeneratorInterface;

/**
 * StubGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Generator\Stub
*/
interface StubGeneratorInterface extends FileGeneratorInterface
{
    /**
     * @param array $patterns
     * @return $this
    */
    public function withPatterns(array $patterns): static;
}
