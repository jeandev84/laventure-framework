<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Factory\Entity;

use PHPUnitTest\App\DTO\Input\Book\BookInputDto;
use PHPUnitTest\App\Entity\Book;

/**
 * BookFactory
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Factory
*/
class BookFactory
{
      /**
       * @param BookInputDto $dto
       * @return Book
      */
      public static function createFromDto(BookInputDto $dto): Book
      {
            $book = new Book();
            $book->setTitle($dto->title);
            $book->setDescription($dto->description);
            $book->setPrice($dto->price);
            return $book;
      }
}