<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Drivers\Mysql\Schema\Table\Column;

use Laventure\Component\Database\Schema\Column\AbstractColumn;

/**
 * MysqlColumn
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Schema\Column\Drivers\Mysql
*/
class MysqlColumn extends AbstractColumn
{
    /**
     * @param string $name
     * @param string $type
    */
    public function __construct(string $name, string $type = '')
    {
        parent::__construct($name, $type);
    }




    /**
     * @return $this
    */
    public function increments(): static
    {
        return $this->increment("AUTO_INCREMENT");
    }





    /**
     * @inheritDoc
    */
    public function signed(): static
    {
        return $this->sign('SIGNED');
    }




    /**
     * @inheritDoc
    */
    public function unsigned(): static
    {
        return $this->sign('UNSIGNED');
    }




    /**
     * @inheritDoc
    */
    public function bigIncrements(): static
    {
        return $this->bigInteger()->increments();
    }





    /**
     * @inheritDoc
    */
    public function integer(int $length = 11): static
    {
        return $this->type("INT($length)");
    }




    /**
     * @inheritDoc
    */
    public function smallInteger(): static
    {
        return $this->type('SMALLINT');
    }





    /**
     * @inheritDoc
    */
    public function bigInteger(): static
    {
        return $this->type('BIGINT');
    }




    /**
     * @inheritDoc
    */
    public function mediumInteger(): static
    {
        return $this->type('MEDIUMINT');
    }





    /**
     * @inheritDoc
    */
    public function tinyInteger(): static
    {
        return $this->type('TINYINT');
    }






    /**
     * @inheritDoc
    */
    public function longText(): static
    {
        return $this->type('LONGTEXT');
    }





    /**
     * @inheritDoc
    */
    public function mediumText(): static
    {
        return $this->type('MEDIUMTEXT');
    }






    /**
     * @inheritDoc
    */
    public function tinyText(): static
    {
        return $this->type('TINYTEXT');
    }







    /**
     * @inheritDoc
    */
    public function char($value): static
    {
        return $this->type("CHAR($value)");
    }






    /**
     * @inheritDoc
    */
    public function date(): static
    {
        return $this->type('DATE');
    }







    /**
     * @inheritDoc
    */
    public function datetime(): static
    {
        return $this->type('DATETIME');
    }







    /**
     * @inheritDoc
    */
    public function time(): static
    {
        return $this->type('TIME');
    }








    /**
     * @inheritDoc
    */
    public function timestamp(): static
    {
        return $this->type('TIMESTAMP');
    }







    /**
     * @inheritDoc
    */
    public function binary(): static
    {
        return $this->type('BINARY');
    }





    /**
     * @inheritDoc
    */
    public function decimal(int $precision, int $scale): static
    {
        return $this->type("DECIMAL($precision, $scale)");
    }





    /**
     * @inheritDoc
    */
    public function double(int $precision, int $scale): static
    {
        // DOUBLE PRECISION OR REAL
        return $this->type("DOUBLE($precision, $scale)");
    }






    /**
     * @inheritDoc
    */
    public function enum(array $values): static
    {
        return $this->type("ENUM(". join(', ', $values) . ")");
    }







    /**
     * @inheritDoc
    */
    public function float(): static
    {
        return $this->type('FLOAT');
    }






    /**
     * @inheritDoc
    */
    public function json(): static
    {
        return $this->type('JSON');
    }








    /**
     * @inheritDoc
    */
    public function morphs(): static
    {

    }






    /**
     * Pseudonym of DECIMAL
     *
     * @return $this
    */
    public function dec(): static
    {
        return $this->type("DEC");
    }





    /**
     * Pseudonym of DECIMAL
     *
     * @return $this
    */
    public function fixed(): static
    {
        return $this->type("FIXED");
    }





    /**
     * @return $this
    */
    public function year(): static
    {
        return $this->type("YEAR");
    }






    /**
     * Returns 0 or 1
     *
     * @inheritDoc
    */
    public function boolean(): static
    {
        return $this->type("BOOL");
    }




    /**
     * @inheritDoc
    */
    public function rename(string $to): string
    {
        return parent::rename("`$to`");
    }



    /**
     * @inheritDoc
    */
    public function drop(): string
    {
        return parent::drop();
    }



    /**
     * @inheritDoc
    */
    public function getPreparedName(): string
    {
        return sprintf('`%s`', $this->getName());
    }
}
