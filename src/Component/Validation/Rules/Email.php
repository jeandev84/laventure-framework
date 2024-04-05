<?php
declare(strict_types=1);

namespace Laventure\Component\Validation\Rules;

use Laventure\Component\Validation\Rules\Contract\ValidationRuleInterface;
use Laventure\Component\Validation\Validators\Contract\ValidatorInterface;

/**
 * Email
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Validation\Rules
*/
#[Attribute]
class Email implements ValidationRuleInterface
{

    /**
     * @inheritDoc
    */
    public function getValidator(): ValidatorInterface
    {
        // TODO: Implement getValidator() method.
    }

    /**
     * @inheritDoc
     */
    public function getName(): string
    {
        // TODO: Implement getName() method.
    }
}