<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Engine;

use Laventure\Component\Templating\Template\Engine\Config\TemplateEngineConfigInterface;
use Laventure\Component\Templating\Template\Transformer\TemplateTransformerInterface;

/**
 * TemplateEngineInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Engine
 */
interface TemplateEngineInterface extends TemplateTransformerInterface
{
    /**
     * @return TemplateEngineConfigInterface
    */
    public function config(): TemplateEngineConfigInterface;
}
