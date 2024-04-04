<?php
declare(strict_types=1);

namespace PHPUnitTest\App\DTO\Input\User;

use PHPUnitTest\App\DTO\Input\Book\BookInputDto;

/**
 * UserInputDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\DTO\Input
*/
class UserInputDto
{


    /**
     * @var BookInputDto[]
    */
    public array $books = [];



    /**
     * @param string|null $username
     * @param string|null $email
     * @param bool|null $active
     * @param string|null $password
    */
    public function __construct(
        public ?string $username,
        public ?string $email,
        public ?string $password,
        public ?bool $active = true
    )
    {
    }





    /**
     * @param BookInputDto $dto
     * @return $this
    */
    public function addBookDto(BookInputDto $dto): static
    {
        $this->books[] = $dto;

        return $this;
    }




    /**
     * @return BookInputDto[]
    */
    public function getBooks(): array
    {
        return $this->books;
    }
}