<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Validators\Contract;


/**
 * ValidatorInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Validators\Contract
*/
interface ValidatorInterface
{

      /**
       * Validate parsed value
       *
       * @param $value
       * @return bool
      */
      public function validate($value): bool;






      /**
       * Returns validator message
       *
       * @param $attribute
       * @return string
      */
      public function message($attribute): string;
}