<?php
declare(strict_types=1);

namespace Laventure\Component\Validation;


use Laventure\Component\Validation\Errors\Contract\ValidationErrorInterface;
use Laventure\Component\Validation\Rules\Contract\ValidationRuleInterface;

/**
 * ValidationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation
*/
interface ValidationInterface
{


       /**
        * Add validation rule
        *
        * @param $field
        * @param ValidationRuleInterface $rule
        * @return $this
       */
       public function addRule($field, ValidationRuleInterface $rule): static;







       /**
        * @param $field
        * @param ValidationRuleInterface[] $rules
        * @return $this
       */
       public function addRules($field, array $rules): static;








       /**
        * Returns validation rules
        *
        * @return array<string, ValidationRuleInterface[]>
       */
       public function getRules(): array;











       /**
        * @param $field
        * @return mixed
       */
       public function getValue($field): mixed;








       /**
        * Returns all data attributes
        *
        * @return array
       */
       public function getData(): array;







       /**
        * Returns error messages
        *
        * @return array<string, ValidationErrorInterface[]>
       */
       public function getErrors(): array;









      /**
       * Validate data object
       *
       * @return bool
      */
      public function validate(): bool;
}