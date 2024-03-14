<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Command\Resolver;

/**
 * CommandNameResolver
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Resolver
 */
class CommandNameResolver
{
    /**
     * @var string|null
    */
    protected ?string $name = null;


    /**
     * @var string
    */
    protected string $separator = ':';




    /**
     * @param string|null $name
    */
    public function __construct(string $name = null)
    {
        if ($name) {
            $this->withName($name);
        }
    }



    /**
     * @param string $name
     * @return $this
     */
    public function withName(string $name): static
    {
        $this->name = $name;

        return $this;
    }




    /**
     * @return bool
    */
    public function hasSeparator(): bool
    {
        return $this->separated($this->name);
    }






    /**
     * @return string
    */
    public function getSeparator(): string
    {
        return $this->separator;
    }




    /**
     * @return string
    */
    public function getFirstName(): string
    {
        return $this->loadNameAsArray()[0] ?? '';
    }





    /**
     * @return array
    */
    public function loadNameAsArray(): array
    {
        if (!$this->hasSeparator()) {
            return [];
        }

        return explode($this->separator, $this->name);
    }




    /**
     * @param $name
     * @return bool
    */
    public function separated($name): bool
    {
        return stripos($name, $this->separator) !== false;
    }




    /**
     * @return string|null
    */
    public function getName(): ?string
    {
        return $this->name;
    }
}
