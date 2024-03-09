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
    /**
     * @var string
    */
    protected string $name;




    /**
     * @var string
    */
    protected string $description;




    /**
     * @var string|null
    */
    protected ?string $default = null;




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
        $this->name        = $name;
        $this->description = $description;
        $this->default     = $default;
        $this->rules       = $rules;
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
}
