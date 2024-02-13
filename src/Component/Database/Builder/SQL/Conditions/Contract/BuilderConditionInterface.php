<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Builder\SQL\Conditions\Contract;


use Laventure\Component\Database\Builder\SQL\BuilderInterface;

/**
 * BuilderConditionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\Conditions\Contract
 */
interface BuilderConditionInterface extends BuilderInterface
{

    /**
     * @param string $condition
     *
     * @return $this
    */
    public function where(string $condition): static;
}