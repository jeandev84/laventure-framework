<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Rules;

use Attribute;
use Laventure\Component\Validation\Rules\Contract\ValidationRuleInterface;
use Laventure\Component\Validation\Validators\Contract\ValidatorInterface;
use Laventure\Component\Validation\Validators\RequiredValidator;


/**
 * Required
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Rules
*/
#[Attribute]
class Required implements ValidationRuleInterface
{

    /**
     * @inheritDoc
    */
    public function getValidator(): ValidatorInterface
    {
       return new RequiredValidator();
    }



    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return 'required';
    }
}