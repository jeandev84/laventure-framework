<?php
declare(strict_types=1);

namespace Laventure\Foundation\Database\ORM;

use Laventure\Component\Config\ConfigInterface;

/**
 * OrmCurrentNameDetector
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Foundation\Database\ORM
*/
class OrmCurrentNameDetector
{
    /**
     * @param ConfigInterface $config
    */
    public function __construct(
        protected ConfigInterface $config
    )
    {
    }




    /**
     * @return string
    */
    public function getTypeName(): string
    {
        return $this->config['database.orm.current'];
    }
}