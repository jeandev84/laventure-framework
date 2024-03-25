<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

use DateTimeImmutable;
use DateTimeInterface;
use Laventure\Component\Database\ORM\Persistence\Collection\ArrayCollection;
use Laventure\Component\Database\ORM\Persistence\Collection\CollectionInterface;

/**
 * User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity\User
*/
class User
{
    /**
     * @var int|null
    */
    private ?int $id = null;




    /**
     * @var string|null
    */
    private ?string $username;



    /**
     * @var string|null
    */
    private ?string $email;




    /**
     * @var string|null
    */
    private ?string $password;





    /**
     * @var bool
    */
    private ?bool $active = false;



    /**
     * @var User|null
    */
    private ?User $followedBy = null;



    /**
     * @var CollectionInterface
    */
    private CollectionInterface $books;



    /**
     * @var DateTimeInterface|null
    */
    private ?DateTimeInterface $createdAt;




    /**
     * @var DateTimeInterface|null
    */
    private ?DateTimeInterface $updatedAt = null;




    /**
     * @var DateTimeInterface|null
    */
    private ?DateTimeInterface $deletedAt = null;



    public function __construct()
    {
        $this->books     = new ArrayCollection();
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
