<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\User;

use PHPUnitTest\App\Entity\ValueObject\UserEmail;
use PHPUnitTest\App\Service\Mailer\MailServiceInterface;

/**
 * UserService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\UserTest
 */
class UserService
{
    public function __construct(protected MailServiceInterface $mailService)
    {
    }


    /**
     * @param UserEmail $userEmail
     * @return bool
    */
    public function sendToUser(UserEmail $userEmail)
    {
        return $this->mailService->sendMail($userEmail->getValue());
    }
}
