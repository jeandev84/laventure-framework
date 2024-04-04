<?php

declare(strict_types=1);

namespace Laventure\Component\Database\Query\Utils;

/**
 * QueryCollection
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\Statement\Utils
*/
class QueryCollection
{
    /**
     * @var string
    */
    protected string $separator = '';



    /**
     * @param array $queries
    */
    public function __construct(
        protected array $queries
    ) {
    }





    /**
     * @param string $separator
     * @return $this
    */
    public function separate(string $separator): static
    {
        $this->separator = $separator;

        return $this;
    }






    /**
     * @return string
    */
    public function toString(): string
    {
        return join($this->separator, array_filter($this->queries));
    }






    /**
     * @return array
    */
    public function toArray(): array
    {
        return $this->queries;
    }
}
