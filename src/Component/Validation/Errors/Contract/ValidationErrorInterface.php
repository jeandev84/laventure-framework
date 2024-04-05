<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Errors\Contract;


use Stringable;

/**
 * ValidationErrorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Errors\Contract
*/
interface ValidationErrorInterface
{

      /**
       * @return string
      */
      public function getField(): string;




      /**
       * @return string
      */
      public function getMessage(): string;
}