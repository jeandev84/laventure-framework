<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Loader;

use Laventure\Component\Templating\Template\Traits\HasTemplateTrait;
use RuntimeException;

/**
 * NullTemplateLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Loader
*/
class NullTemplateLoader implements TemplateLoaderInterface
{
    use HasTemplateTrait;


    /**
     * @inheritDoc
    */
    public function load(): mixed
    {
        throw new RuntimeException("Could not load template from : ". __METHOD__);
    }
}
