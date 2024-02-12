<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Contract;

/**
 * HasTemplateResourceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Contract
 */
interface HasTemplateResourceInterface
{
    /**
     * @param string $resourcePath
     *
     * @return $this
    */
    public function withResource(string $resourcePath): static;




    /**
     * Returns template resource path
     *
     * @return string
    */
    public function getResource(): string;
}
