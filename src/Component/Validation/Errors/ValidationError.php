<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Errors;

use Laventure\Component\Validation\Errors\Contract\ValidationErrorInterface;

/**
 * ValidationError
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Errors
*/
class ValidationError implements ValidationErrorInterface
{

    /**
     * @param string $field
     * @param string $message
    */
    public function __construct(
        protected string $field,
        protected string $message
    )
    {
    }




    /**
     * @inheritDoc
    */
    public function getField(): string
    {
        return $this->field;
    }






    /**
     * @inheritDoc
    */
    public function getMessage(): string
    {
        return $this->message;
    }
}