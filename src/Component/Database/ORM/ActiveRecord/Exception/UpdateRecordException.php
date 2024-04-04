<?php

declare(strict_types=1);

namespace Laventure\Component\Database\ORM\ActiveRecord\Exception;

use Laventure\Component\Database\ORM\ActiveRecord\Contract\ActiveRecordInterface;
use Throwable;

/**
 * UpdateRecordException
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\ActiveRecord\Exception
*/
class UpdateRecordException extends ActiveRecordException
{
    public function __construct(ActiveRecordInterface $model, array $data = [])
    {
        $id        = $model->getId();
        $classname = $model->getClassName();
        $message   = "Something went wrong during updating model ($classname), where id ($id)";

        parent::__construct($message, $data, 500);
    }
}
