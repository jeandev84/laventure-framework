<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

/**
 * Book
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
*/
class Book
{
    /**
     * @var int|null
    */
    private ?int $id = null;


    /**
     * @var string|null
    */
    private ?string $title;



    /**
     * @var string|null
    */
    private ?string $description;




    /**
     * @var float|null
    */
    private ?float $price;




    /**
     * @var User|null
    */
    private ?User $user = null;



    public function __construct(
        string $title,
        string $description,
        float $price,
        int $id = null
    ) {
        $this->title = $title;
        $this->description = $description;
        $this->price = $price;
        $this->id  = $id;
    }



    /**
      * @return int|null
     */
    public function getId(): ?int
    {
        return $this->id;
    }




    /**
     * @return string|null
     */
    public function getTitle(): ?string
    {
        return $this->title;
    }




    /**
     * @param string|null $title
     * @return $this
    */
    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }




    /**
     * @return string|null
    */
    public function getDescription(): ?string
    {
        return $this->description;
    }




    /**
     * @param string|null $description
     * @return $this
    */
    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }




    /**
     * @return float|null
    */
    public function getPrice(): ?float
    {
        return $this->price;
    }




    /**
     * @param float|null $price
     * @return $this
    */
    public function setPrice(?float $price): static
    {
        $this->price = $price;

        return $this;
    }




    /**
     * @return User|null
    */
    public function getUser(): ?User
    {
        return $this->user;
    }




    /**
     * @param User|null $user
     *
     * @return $this
    */
    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }
}
