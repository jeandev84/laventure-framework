<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Repository;

use Laventure\Component\Database\ORM\Manager\Contract\EntityManagerInterface;
use Laventure\Component\Database\ORM\Manager\Repository\ServiceEntityRepository;
use PHPUnitTest\App\Entity\Book;

/**
 * BookRepository
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Repository
*/
class BookEntityRepository extends ServiceEntityRepository
{
    /**
     * @param EntityManagerInterface $em
    */
    public function __construct(EntityManagerInterface $em)
    {
        parent::__construct($em, Book::class);
    }




    /**
     * @return Book[]
    */
    public function getBooks(): array
    {
        return [
            new Book('PHP1', 'PHP1 book for beginner in php.', 345.68),
            new Book('PHP2', 'PHP2 book for middle in php.', 345.68),
            new Book('PHP3', 'PHP3 book for specialist in php.', 345.68),
            new Book('PHP4', 'PHP4 book for advanced in php.', 345.68),
        ];
    }
}
