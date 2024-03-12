<?php
declare(strict_types=1);

namespace Laventure\Component\Filesystem\File\Generator;


use Laventure\Contract\Generator\GeneratorInterface;

/**
 * FileGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Filesystem\File\Generator
*/
interface FileGeneratorInterface extends GeneratorInterface
{

      /**
       * Returns target path
       *
       * @return string|null
      */
      public function getTargetPath(): ?string;






       /**
        * Returns content
        *
        * @return string
       */
       public function getContent(): string;






       /**
        * Determine if file successfully generated
        *
        * @return bool
       */
       public function generatedFile(): bool;
}