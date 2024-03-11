<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Param;

use Laventure\Component\Console\Input\Rules\InputRulesInterface;

/**
 * InputParam
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Input\Parameter
*/
abstract class InputParam implements InputParamInterface, InputRulesInterface
{
    public const REQUIRED = 0;
    public const OPTIONAL = 1;


    /**
     * @var null
    */
    protected $name;




    /**
     * @var null
    */
    protected $description = null;




    /**
     * @var string|null
    */
    protected $default = null;




    /**
     * @var array
    */
    protected $options = [];





    /**
     * @var array
    */
    protected array $rules = [];




    /**
     * @param $name
     * @param $description
     * @param $default
     * @param array $rules
    */
    public function __construct(
        $name,
        $description,
        $default = null,
        array $rules = []
    ) {
        $this->name($name)
             ->description($description)
             ->default($default)
             ->rules($rules);
    }




    /**
     * @inheritDoc
    */
    public function name($name): static
    {
        $this->name = $name;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function description($description): static
    {
        $this->description = $description;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function default($default): static
    {
        $this->default = $default;

        return $this;
    }






    /**
     * @inheritDoc
    */
    public function rules(array $rules): static
    {
        $this->rules = $rules;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function getName(): string
    {
        return $this->name;
    }




    /**
     * @inheritDoc
    */
    public function getDescription(): string
    {
        return $this->description;
    }




    /**
     * @inheritDoc
    */
    public function getDefault(): ?string
    {
        return $this->default;
    }




    /**
     * @inheritDoc
    */
    public function getRules(): array
    {
        return $this->rules;
    }




    /**
     * @inheritDoc
    */
    public function hasRule($rule): bool
    {
        return in_array($rule, $this->rules);
    }




    /**
     * @inheritDoc
    */
    public function required(): static
    {
        return $this->rules([static::REQUIRED]);
    }





    /**
     * @inheritDoc
    */
    public function optional(): static
    {
        return $this->rules([static::OPTIONAL]);
    }


    /**
     * @inheritDoc
    */
    public function isRequired(): bool
    {
        return $this->hasRule(static::REQUIRED);
    }




    /**
     * @inheritDoc
    */
    public function isOptional(): bool
    {
        return $this->hasRule(static::OPTIONAL);
    }




    /**
     * @inheritDoc
    */
    public function readAsString(): string
    {
        return sprintf('%s %s', $this->name, $this->description);
    }



    /**
     * @inheritDoc
    */
    public function __toString()
    {
        return $this->readAsString();
    }
}
