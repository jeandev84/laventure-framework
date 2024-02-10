<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\Mailer;

/**
 * MailServiceInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Mailer
 */
interface MailServiceInterface
{
    /**
     * @param string $to
     * @return bool
    */
    public function sendMail(string $to): bool;
}
