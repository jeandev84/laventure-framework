<?php
declare(strict_types=1);

namespace Laventure\Contract\Generator;


/**
 * IdentifierGeneratorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Contract\Generator
 */
interface IdentifierGeneratorInterface
{
      /**
       * @return mixed
      */
      public function generateId(): mixed;
}