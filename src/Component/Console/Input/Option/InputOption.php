<?php

declare(strict_types=1);

namespace Laventure\Component\Console\Input\Option;

use Laventure\Component\Console\Input\Param\InputParam;

/**
 * InputOption
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\InputArgv\Option
*/
class InputOption extends InputParam implements InputOptionInterface
{
    public const REQUIRED = 4;
    public const OPTIONAL = 5;


    /**
     * @var null
    */
    protected $shortcut = null;



    /**
     * @param $name
     * @param $description
     * @param $shortcut
     * @param $default
     * @param array $rules
    */
    public function __construct(
        $name,
        $description,
        $shortcut = null,
        $default = null,
        array $rules = []
    ) {
        parent::__construct($name, $description, $default, $rules);
        $this->shortcut($shortcut);
    }




    /**
     * @inheritDoc
    */
    public function getShortCut(): ?string
    {
        return $this->shortcut;
    }




    /**
     * @inheritDoc
    */
    public function shortcut($shortcut): static
    {
        $this->shortcut = $shortcut;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function readAsString(): string
    {
        return sprintf('%s %s', $this->getOptionsAsString(), $this->description);
    }





    /**
     * @inheritDoc
    */
    public function getOptionsAsString(): string
    {
        if ($this->shortcut) {
            $this->shortcut = "-{$this->shortcut},";
        }

        return sprintf('%s --%s', $this->shortcut, $this->name);
    }
}
