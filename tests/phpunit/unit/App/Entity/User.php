<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Laventure\Component\Database\ORM\Common\Collection\Contract\CollectionInterface;
use Laventure\Component\Database\ORM\Common\Collection\Collection;
use Laventure\Component\Database\ORM\Mapping\Attributes\Column;
use Laventure\Component\Database\ORM\Mapping\Attributes\Id;
use Laventure\Component\Database\ORM\Mapping\Attributes\OneToMany;
use Laventure\Component\Database\ORM\Mapping\Attributes\Table;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;


/**
 * User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity\User
*/
#[Table('users')]
class User
{
    /**
     * @var int|null
    */
    #[Id]
    private ?int $id = null;




    /**
     * @var string|null
    */
    #[Column(length: 230)]
    private ?string $username;



    /**
     * @var string|null
    */
    #[Column(length: 50)]
    private ?string $email;




    /**
     * @var string|null
    */
    #[Column(length: 150)]
    private ?string $password;





    /**
     * @var bool
    */
    #[Column(type: ColumnType::BOOLEAN)]
    private ?bool $active = false;





    /**
     * Relation (OneToMany)
     *
     * @var CollectionInterface
    */
    #[OneToMany(targetEntity: Book::class, mappedBy: 'users')]
    private CollectionInterface $books;





    /**
     * @var DateTimeInterface|null
    */
    #[Column(type: ColumnType::DATETIME)]
    private ?DateTimeInterface $createdAt;




    /**
     * @var DateTimeInterface|null
    */
    #[Column(type: ColumnType::DATETIME)]
    private ?DateTimeInterface $updatedAt = null;




    /**
     * @var DateTimeInterface|null
    */
    #[Column(type: ColumnType::DATETIME)]
    private ?DateTimeInterface $deletedAt = null;



    public function __construct()
    {
        $this->books     = new Collection();
        $this->createdAt = new DateTimeImmutable();
    }




    /**
     * @return int|null
    */
    public function getId(): ?int
    {
        return $this->id;
    }






    /**
     * @param string|null $email
     *
     * @return $this
    */
    public function setEmail(?string $email): static
    {
        $this->email = $email;

        return $this;
    }





    /**
     * @return string|null
    */
    public function getEmail(): ?string
    {
        return $this->email;
    }




    /**
     * @param string|null $username
     *
     * @return $this
    */
    public function setUsername(?string $username): static
    {
        $this->username = $username;

        return $this;
    }




    /**
     * @param string|null $password
     *
     * @return $this
    */
    public function setPassword(?string $password): static
    {
        $this->password = $password;

        return $this;
    }






    /**
     * @return string|null
    */
    public function getUsername(): ?string
    {
        return $this->username;
    }





    /**
     * @return string|null
    */
    public function getPassword(): ?string
    {
        return $this->password;
    }







    /**
     * @return bool|null
    */
    public function getActive(): ?bool
    {
        return $this->active;
    }






    /**
     * @param bool|null $active
     * @return $this
    */
    public function setActive(?bool $active): static
    {
        $this->active = $active;

        return $this;
    }





    /**
     * @param Book $book
     * @return $this
    */
    public function addBook(Book $book): static
    {
        $book->setUser($this);

        $this->books->add($book);

        return $this;
    }





    /**
     * @param Book $book
     * @return $this
    */
    public function remove(Book $book): static
    {
        $book->setUser(null);

        $this->books->remove($book);

        return $this;
    }




    /**
     * @return CollectionInterface
    */
    public function getBooks(): CollectionInterface
    {
        return $this->books;
    }






    /**
     * @return DateTimeInterface|null
    */
    public function getCreatedAt(): ?DateTimeInterface
    {
        return $this->createdAt;
    }




    /**
     * @param DateTimeInterface|null $createdAt
     * @return $this
    */
    public function setCreatedAt(?DateTimeInterface $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }




    /**
     * @return DateTimeInterface|null
     */
    public function getUpdatedAt(): ?DateTimeInterface
    {
        return $this->updatedAt;
    }




    /**
     * @param DateTimeInterface|null $updatedAt
     * @return $this
    */
    public function setUpdatedAt(?DateTimeInterface $updatedAt): static
    {
        $this->updatedAt = $updatedAt;

        return $this;
    }




    /**
     * @return DateTimeInterface|null
    */
    public function getDeletedAt(): ?DateTimeInterface
    {
        return $this->deletedAt;
    }






    /**
     * @param DateTimeInterface|null $deletedAt
     * @return $this
    */
    public function setDeletedAt(?DateTimeInterface $deletedAt): static
    {
        $this->deletedAt = $deletedAt;

        return $this;
    }


    /**
     * @return User|null
     */
    public function getFollowedBy(): ?User
    {
        return $this->followedBy;
    }


    /**
     * @param User|null $followedBy
    */
    public function setFollowedBy(?User $followedBy): void
    {
        $this->followedBy = $followedBy;
    }
}
