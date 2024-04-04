<?php

declare(strict_types=1);

namespace Laventure\Component\Templating\Template\Reader;

use Laventure\Component\Templating\Template\Traits\HasTemplateTrait;
use RuntimeException;

/**
 * NullTemplateReader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Templating\Template\Reader
*/
class NullTemplateReader implements TemplateReaderInterface
{
    use HasTemplateTrait;

    public function __construct()
    {
    }


    /**
     * @inheritDoc
    */
    public function read(): mixed
    {
        throw new RuntimeException('Could not read template from : '. __METHOD__);
    }
}
