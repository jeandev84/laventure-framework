<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Factory\Entity;

use DateTimeImmutable;
use PHPUnitTest\App\DTO\Input\User\UserInputDto;
use PHPUnitTest\App\Entity\User;
use PHPUnitTest\App\Service\Hash\EncryptedPassword;

/**
 * UserFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Factory
*/
class UserFactory
{

    /**
     * @param UserInputDto $dto
     * @return User
    */
    public static function createFromDto(UserInputDto $dto): User
    {
        $user = new User();
        $user->setUsername($dto->username)
             ->setEmail($dto->email)
             ->setActive($dto->active)
             ->setPassword(EncryptedPassword::encrypt($dto->password))
             ->setCreatedAt(createdAt: new DateTimeImmutable());

        foreach($dto->books as $bookDto) {
            $user->addBook(BookFactory::createFromDto($bookDto));
        }

        return $user;
    }
}