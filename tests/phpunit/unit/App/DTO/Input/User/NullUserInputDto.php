<?php
declare(strict_types=1);

namespace PHPUnitTest\App\DTO\Input\User;

/**
 * NullUserInputDto
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  PHPUnitTest\App\DTO\Input\User
*/
class NullUserInputDto extends UserInputDto
{
   public function __construct()
   {
       parent::__construct(null, null, null, null);
   }
}