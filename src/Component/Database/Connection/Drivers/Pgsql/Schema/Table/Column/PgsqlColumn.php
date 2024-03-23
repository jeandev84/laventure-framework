<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Drivers\Pgsql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\AbstractColumn;

/**
 * PgsqlColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Pgsql
 */
class PgsqlColumn extends AbstractColumn
{

    /**
     * @inheritDoc
    */
    public function increment(): static
    {
        return $this->type("SERIAL");
    }




    /**
     * @inheritDoc
    */
    public function signed(): static
    {
        return $this->withSign("CHECK($this->name > 0)");
    }




    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        return $this->withSign("CHECK($this->name < 0)");
    }





    /**
     * @inheritDoc
    */
    protected function getTypeCriteria(): string
    {
        return $this->getSign();
    }
}
