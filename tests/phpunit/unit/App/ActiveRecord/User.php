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
 *
 * @method static User find(int $id)
 * @method static User[] all()
*/
class User extends Model
{

     /**
      * @var string
     */
     protected $table = 'users';



     /* protected $timestamps = false; */



     /**
      * @var string[]
     */
     protected $fill  = [
         'username',
         'email',
         'password',
         'active'
     ];
}