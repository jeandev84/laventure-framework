<?php
declare(strict_types=1);

namespace Laventure\Component\Database\Connection\Query\Builder\SQL\DML\Insert;

use Laventure\Component\Database\Connection\ConnectionInterface;
use Laventure\Component\Database\Connection\Query\Builder\SQL\Commands\Insert;
use Laventure\Component\Database\Connection\Query\Builder\SQL\SQLBuilder;


/**
 * InsertBuilder
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Builder\SQL\DML\Insert
*/
class InsertBuilder extends SQLBuilder implements InsertBuilderInterface
{


    /**
     * @var InsertResolverInterface
    */
    protected InsertResolverInterface $insertResolver;



    /**
     * @var string|null
    */
    public ?string $table = null;



    /**
     * @var array
    */
    public array $insert = [];



    /**
     * @var array
    */
    public array $values = [];




    /**
     * @param ConnectionInterface $connection
    */
    public function __construct(ConnectionInterface $connection)
    {
        parent::__construct($connection);
        $this->insertResolver = new InsertResolver($this);
    }




    /**
     * @inheritDoc
    */
    public function insert(string $table): static
    {
        $this->table = $table;

        return $this;
    }



    /**
     * @inheritDoc
    */
    public function values(array $values): static
    {
        /*
        $this->insert   = array_keys($values);
        $this->values[] = $values;
        */

        if (isset($values[0])) {
            $this->insertResolver->resolveMultipleInsert($values);
        } else {
            $this->insertResolver->resolveInsert($values);
        }

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function setValue(string $column, $value, int $index = 0): static
    {
        if ($index < 0) { $index = 0; }

        if (!isset($this->values[$index])) {
            $this->values[$index] = [];
        }

        $this->insert[$column] = $column;
        $this->values[$index][$column] = $value;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function addInsertResolver(InsertResolverInterface $insertResolver): static
    {
        // TODO: Implement addInsertResolver() method.
    }



    /**
     * @inheritDoc
    */
    public function getCommands(): array
    {
        return [
            new Insert($this->table, $this->insert, $this->values)
        ];
    }
}
