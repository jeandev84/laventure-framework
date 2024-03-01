<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Contract;

use Stringable;

/**
 * TemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Contract
*/
interface TemplateInterface extends Stringable
{
    /**
     * Returns path of template
     *
     * @return string
    */
    public function getPath(): string;





    /**
     * Returns template parameters
     *
     * @return array
    */
    public function getParameters(): array;




    /**
     * @param string $cacheKey
     *
     * @return $this
    */
    public function withCacheKey(string $cacheKey): static;




    /**
     * Generate unique key
     *
     * @return string
    */
    public function getCacheKey(): string;
}
