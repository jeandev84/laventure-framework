<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord;


use Laventure\Component\Database\ORM\ActiveRecord\Entity\ActiveRecordEntityInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Repository\ActiveRecordRepositoryInterface;

/**
 * ActiveRecordInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord
 */
interface ActiveRecordInterface extends ActiveRecordEntityInterface, ActiveRecordRepositoryInterface
{

}