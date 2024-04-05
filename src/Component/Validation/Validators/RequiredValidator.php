<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Validators;

use Laventure\Component\Validation\Validators\Contract\ValidatorInterface;

/**
 * RequiredValidator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Validators
*/
class RequiredValidator implements ValidatorInterface
{

    /**
     * @inheritDoc
    */
    public function validate($value): bool
    {
        return !empty($value);
    }




    /**
     * @inheritDoc
    */
    public function message($attribute): string
    {
        return sprintf('%s is required', $attribute);
    }
}