<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Entity;

use Laventure\Component\Database\ORM\Mapping\Attributes\Column;
use Laventure\Component\Database\ORM\Mapping\Attributes\Id;
use Laventure\Component\Database\ORM\Mapping\Attributes\ManyToOne;
use Laventure\Component\Database\ORM\Mapping\Attributes\OneToMany;
use Laventure\Component\Database\ORM\Mapping\Attributes\Table;
use Laventure\Component\Database\Schema\Column\Types\ColumnType;

/**
 * Book
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Entity
*/
#[Table('books')]
class Book
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
    private ?string $title;



    /**
     * @var string|null
    */
    #[Column(type: ColumnType::TEXT)]
    private ?string $description;




    /**
     * @var float|null
    */
    #[Column(type: ColumnType::FLOAT)]
    private ?float $price;




    /**
     * Relation (ManyToOne)
     * @var User|null
    */
    #[ManyToOne(inversedBy: 'books')]
    private ?User $user = null;




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
