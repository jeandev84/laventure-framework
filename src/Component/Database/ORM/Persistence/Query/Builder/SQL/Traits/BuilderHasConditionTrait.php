<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Query\Builder\SQL\Traits;


/**
 * BuilderHasConditionTrait
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Query\Builder\Traits
*/
trait BuilderHasConditionTrait
{

    use BuilderTrait;



    /**
     * @param array $conditions
     * @return $this
    */
    public function criteria(array $conditions): static
    {

    }
}