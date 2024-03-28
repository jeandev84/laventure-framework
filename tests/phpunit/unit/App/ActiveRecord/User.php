<?php
declare(strict_types=1);

namespace PHPUnitTest\App\ActiveRecord;

use Laventure\Component\Database\ORM\ActiveRecord\Contract\Timestamps\TimestampsInterface;
use Laventure\Component\Database\ORM\ActiveRecord\Traits\Timestamps;
use Laventure\Foundation\Database\ORM\Model\Model;

/**
 * User
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  App\ORM\ActiveRecord
*/
class User extends Model
{

     /**
      * @var string
     */
     protected $table = 'users';



     /**
      * @var bool
     */
     protected $timestamp = true;



     /**
      * @var string[]
     */
     protected $save  = [
         'username',
         'email',
         'password',
         'active'
     ];
}