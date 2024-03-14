<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Manager\Config\Common\Migration;


use Laventure\Component\Database\Manager\Config\Common\CommonConfigurationInterface;

/**
 * MigrationConfigurationInterface
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Manager\Config\ORM\Mapper\Migration
 */
interface MigrationConfigurationInterface extends CommonConfigurationInterface
{
      /**
       * @return string
      */
      public function version(): string;
}