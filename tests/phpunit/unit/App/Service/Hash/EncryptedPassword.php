<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Service\Hash;

/**
 * EncryptedPassword
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Hash
 */
class EncryptedPassword
{
    /**
     * @param string $plainPassword
     * @return string
    */
    public static function encrypt(string $plainPassword): string
    {
        return password_hash($plainPassword, PASSWORD_DEFAULT);
    }
}
