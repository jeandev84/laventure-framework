<?php
declare(strict_types=1);

namespace Laventure\Component\Console\Command\Contract;


/**
 * OptionCommandInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Console\Command\Contract
*/
interface OptionCommandInterface extends CommandInterface
{

     /**
      * Returns option shortcut name
      *
      * @return string
     */
     public function getShortcutName(): string;




     /**
      * @return string
     */
     public function getLongOptions(): string;
}