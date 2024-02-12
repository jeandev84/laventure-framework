<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Compiler;

/**
 * CompilerInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Compiler\Writer
 */
interface CompilerInterface
{
    /**
     * Convert tags to php code
     *
     * @param string $content
     * @return string
    */
    public function compile(string $content): string;
}
