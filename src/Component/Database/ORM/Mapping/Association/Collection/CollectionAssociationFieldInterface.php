<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Association\Collection;


use Laventure\Component\Database\ORM\Common\Collection\Contract\HasCollectionInterface;
use Laventure\Component\Database\ORM\Mapping\Association\AssociatedFieldInterface;

/**
 * CollectionAssociationFieldInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Data\Metadata\Field\Types\Association\Collection
 */
interface CollectionAssociationFieldInterface extends AssociatedFieldInterface, HasCollectionInterface
{

}