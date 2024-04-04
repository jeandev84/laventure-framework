<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Common\Collection\Contract;


/**
 * HasCollectionInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Common\Collection\Contract
 */
interface HasCollectionInterface
{
    /**
     * @return CollectionInterface
    */
    public function getCollection(): CollectionInterface;
}