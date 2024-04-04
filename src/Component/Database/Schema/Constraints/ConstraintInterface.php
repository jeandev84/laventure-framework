<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints;

use Laventure\Component\Database\Query\Builder\SQL\Contract\SQLInterface;
use Laventure\Contract\Options\HasOptionInterface;
use Stringable;

/**
 * ConstraintInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints
*/
interface ConstraintInterface extends HasOptionInterface, SQLInterface
{
    /**
     * Returns constraint name
     *
     * @return string
    */
    public function getType(): string;




    /**
     * Returns constraint key
     *
     * @return string|null
    */
    public function getName(): ?string;






    /**
     * @param string $name
     * @return $this
    */
    public function name(string $name): static;
}
