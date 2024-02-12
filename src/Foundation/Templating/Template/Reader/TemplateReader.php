<?php
declare(strict_types=1);

namespace Laventure\Foundation\Templating\Template\Reader;

use Laventure\Component\Filesystem\File\File;
use Laventure\Component\Filesystem\Filesystem;
use Laventure\Component\Templating\Template\Exception\NotFoundTemplateException;
use Laventure\Component\Templating\Template\HasTemplateTrait;
use Laventure\Component\Templating\Template\Reader\TemplateReaderInterface;

/**
 * TemplateReader
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Templating\Reader
*/
class TemplateReader implements TemplateReaderInterface
{
      use HasTemplateTrait;


      /**
       * @param Filesystem $filesystem
      */
      public function __construct(Filesystem $filesystem)
      {
      }



      /**
       * @inheritDoc
      */
      public function read(): string
      {
          $file = new File($this->template->getPath());

          if (!$file->exists()) {
              throw new NotFoundTemplateException($file->getPath());
          }

          return $file->read();
      }
}