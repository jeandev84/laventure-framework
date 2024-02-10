<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\Mailer;

/**
 * PHPUnitTest\App\Service\Mailer
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Mailer
*/
class MailService implements MailServiceInterface
{
    /**
     * @param string $from
     * @param string $root
    */
    public function __construct(
        protected string $from,
        protected string $root = ''
    ) {
    }





    /**
     * @return string
    */
    public function getRoot(): string
    {
        return $this->root;
    }





    /**
     * @inheritdoc
    */
    public function sendMail(string $to): bool
    {
        echo "From {$this->from} | sending to {$to}...";
        return true;
    }
}
