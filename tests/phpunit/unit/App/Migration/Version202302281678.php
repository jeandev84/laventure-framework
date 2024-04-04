<?php

namespace PHPUnitTest\App\Migration;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Migration\Migration;
use Laventure\Component\Database\Schema\SchemaInterface;

class Version202302281678 extends Migration
{
    /**
     * @inheritDoc
    */
    public function up(SchemaInterface $schema): void
    {
        $schema->create('products', function (Blueprint $table) {
            $table->integer('id')->primary()->increment();
            $table->string('name');
            $table->boolean('test')->default(0);
            $table->float('price');
        });


        $qb = $schema->getConnection()->createQueryBuilder();

        $qb->insert('products')
            ->values([
                [
                    'name'  => 'Tourelle de Defense',
                    'price' => 150.20
                ],
                [
                    'name'  => 'Tourelle de niveau 3',
                    'price' => 125
                ]
            ])
            ->getQuery()->execute();
    }




    /**
     * @inheritDoc
    */
    public function down(SchemaInterface $schema): void
    {
        $schema->dropIfExists('products');
    }
}
