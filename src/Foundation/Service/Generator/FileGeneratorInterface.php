<?php
declare(strict_types=1);

namespace Laventure\Foundation\Service\Generator;


use Laventure\Contract\Generator\GeneratorInterface;

/**
 * FileGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Service\Generator
*/
interface FileGeneratorInterface extends GeneratorInterface
{
      /**
       * @param $path
       * @return $this
      */
      public function withTargetPath($path): static;




      /**
       * @param $content
       * @return $this
      */
      public function withContent($content): static;





      /**
       * Returns target path
       *
       * @return string|null
      */
      public function getTargetPath(): ?string;








       /**
        * Returns content
        *
        * @return string|null
       */
       public function getContent(): ?string;
}