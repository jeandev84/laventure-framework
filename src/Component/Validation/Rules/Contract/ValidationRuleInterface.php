<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Rules\Contract;


use Laventure\Component\Validation\Validators\Contract\ValidatorInterface;

/**
 * ValidationRuleInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Rules\Contract
*/
interface ValidationRuleInterface
{

      /**
       * Returns rule validator
       *
       * @return ValidatorInterface
      */
      public function getValidator(): ValidatorInterface;





      /**
       * Returns validation rule name
       *
       * @return string
      */
      public function getName(): string;
}