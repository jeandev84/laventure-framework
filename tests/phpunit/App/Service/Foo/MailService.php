<?php
declare(strict_types=1);

namespace PHPUnitTest\App\Service\Foo;

/**
 * FooService
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\Service\Foo
*/
class MailService
{

     /**
      * @return bool
     */
     public function sendMail(): bool
     {
         echo "sending mail ...";
         return true;
     }
}