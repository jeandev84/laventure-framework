<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

use Laventure\Component\Templating\Template\Contract\HasTemplateInterface;

/**
 * CompiledTemplateInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler
*/
interface CompiledTemplateInterface extends HasTemplateInterface
{
    /**
     * @param string $compiled
     *
     * @return $this
    */
    public function withCompiled(string $compiled): static;



    /**
     * Returns compiled content
     *
     * @return string
    */
    public function getCompiled(): string;
}
