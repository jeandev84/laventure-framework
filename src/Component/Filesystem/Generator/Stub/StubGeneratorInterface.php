<?php
declare(strict_types=1);

namespace Laventure\Component\Filesystem\Generator\Stub;

use Laventure\Contract\Generator\GeneratorInterface;

/**
 * StubGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\Generator\Stub
*/
interface StubGeneratorInterface extends GeneratorInterface
{


    /**
     * @param string $stubPath
     * @return $this
    */
    public function withStubPath(string $stubPath): static;




    /**
     * @param array $patterns
     * @return $this
    */
    public function withPatterns(array $patterns): static;
}
