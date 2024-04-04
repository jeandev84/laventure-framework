<?php

declare(strict_types=1);

namespace Laventure\Foundation\Templating\Template\Loader;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Templating\Template\Exception\NotFoundTemplateException;
use Laventure\Component\Templating\Template\Loader\TemplateLoaderInterface;
use Laventure\Component\Templating\Template\Traits\HasTemplateTrait;

/**
 * TemplateLoader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Templating\Loader
*/
class TemplateLoader implements TemplateLoaderInterface
{
    use HasTemplateTrait;


    /**
     * @inheritDoc
    */
    public function load(): string
    {
        $file = new File($this->template->getPath());

        if (!$file->exists()) {
            throw new NotFoundTemplateException($file->getPath());
        }

        extract($this->template->getParameters(), EXTR_SKIP);
        ob_start();
        require $file->getPath();
        return ob_get_clean();
    }
}
