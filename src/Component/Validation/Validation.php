<?php
declare(strict_types=1);

namespace Laventure\Component\Validation;

use Laventure\Component\Validation\Errors\Contract\ValidationErrorInterface;
use Laventure\Component\Validation\Errors\ValidationError;
use Laventure\Component\Validation\Rules\Contract\ValidationRuleInterface;

/**
 * Validation
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation
*/
class Validation implements ValidationInterface
{


    /**
     * @var array<string, ValidationRuleInterface[]>
    */
    protected array $rules = [];





    /**
     * @var array<string, ValidationErrorInterface>
    */
    protected array $errors = [];






    /**
     * @var array
    */
    protected array $data = [];








    /**
     * Set data
     *
     * @param array $data
     * @return $this
    */
    public function data(array $data): static
    {
        foreach ($data as $field => $value) {
            $this->setValue($field, $value);
        }

        return $this;
    }








    /**
     * @inheritDoc
    */
    public function addRule($field, ValidationRuleInterface $rule): static
    {
         $this->rules[$field][$rule->getName()] = $rule;

         return $this;
    }






    /**
     * @inheritDoc
    */
    public function addRules($field, array $rules): static
    {
          foreach ($rules as $rule) {
              $this->addRule($field, $rule);
          }

          return $this;
    }








    /**
     * @param $field
     * @param $value
     * @return $this
    */
    public function setValue($field, $value): static
    {
        $this->data[$field] = $value;

        return $this;
    }







    /**
     * @inheritDoc
    */
    public function getValue($field): mixed
    {
        return $this->data[$field] ?? null;
    }







    /**
     * @inheritDoc
    */
    public function getRules(): array
    {
        return $this->rules;
    }








    /**
     * @inheritDoc
    */
    public function getErrors(): array
    {
        return $this->errors;
    }







    /**
     * @inheritDoc
    */
    public function getData(): array
    {
        return $this->data;
    }









    /**
     * @param ValidationErrorInterface $error
     * @return $this
    */
    public function addError(ValidationErrorInterface $error): static
    {
         $this->errors[$error->getField()][] = $error;

         return $this;
    }







    /**
     * @inheritDoc
    */
    public function validate(): bool
    {
         foreach ($this->rules as $field => $rules) {
             foreach ($rules as $rule) {
                 $validator = $rule->getValidator();
                 if (!$validator->validate($this->getValue($field))) {
                     $this->addError(
                         new ValidationError($field, $validator->message($field))
                     );
                 }
             }
         }

         return empty($this->errors);
    }
}