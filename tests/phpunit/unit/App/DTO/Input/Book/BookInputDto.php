<?php
declare(strict_types=1);

namespace PHPUnitTest\App\DTO\Input\Book;

use PHPUnitTest\App\DTO\Input\User\NullUserInputDto;
use PHPUnitTest\App\DTO\Input\User\UserInputDto;

/**
 * BookInputDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\DTO\Input
*/
class BookInputDto
{

      /**
       * @var UserInputDto
      */
      protected UserInputDto $userInputDto;




      /**
       * @param string|null $title
       * @param string|null $description
       * @param float|null $price
      */
      public function __construct(
          public ?string $title,
          public ?string $description,
          public ?float $price = null
      )
      {
          $this->userInputDto = new NullUserInputDto();
      }


      /**
       * @param UserInputDto $userInputDto
      */
      public function setUserInputDto(UserInputDto $userInputDto): void
      {
           $this->userInputDto = $userInputDto;
      }




      /**
       * @return UserInputDto
      */
      public function getUserInputDto(): UserInputDto
      {
          return $this->userInputDto;
      }
}