<?php
declare(strict_types=1);

namespace Laventure\Component\Database\ORM\Persistence\Mapper\Identity\Generator;

/**
 * DataIdentifierGenerator
 *
 * @author Jean-Claude <jeanyao@ymail.com>
 *
 * @license https://github.com/jeandev84/laventure-framework/blob/master/LICENSE
 *
 * @package  Laventure\Component\Database\ORM\Persistence\Mapper\Identity
 */
class DataIdentifierGenerator implements DataIdentifierGeneratorInterface
{


    /**
     * @var mixed
    */
    protected $id;


    /**
     * @param $class
    */
    public function __construct(protected $class = null)
    {
    }




    /**
     * @inheritDoc
    */
    public function withClass($class): static
    {
        $this->class = $class;

        return $this;
    }





    /**
     * @inheritDoc
    */
    public function withRecordId($id): static
    {
        $this->id = $id;

        return $this;
    }




    /**
     * @inheritDoc
    */
    public function generateId(): string
    {
        return "{$this->class}.{$this->id}";
    }
}