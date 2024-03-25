<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Schema\Constraints\Contract;

use Laventure\Component\Database\Query\Builder\SQL\Contract\SQLInterface;
use Stringable;

/**
 * ConstrainedInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Constraints\Contract
 */
interface ConstrainedInterface extends SQLInterface
{
    /**
     * @param string|null $value
     * @return $this
    */
    public function onDelete(string $value = null): static;




    /**
     * @param string|null $value
     * @return $this
    */
    public function onUpdate(string $value = null): static;
}
