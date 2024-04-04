<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Mapping\Relationship\Exception;

/**
 * NotFoundRelationshipException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Data\Metadata\Relationship\Exception
 */
class NotFoundRelationshipException extends RelationshipException
{
    public function __construct(string $field, array $data = [])
    {
        parent::__construct("Not found relationship for ($field)", $data, 404);
    }
}