<?php

namespace PHPUnitTest\App\Migration;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Migration\Migration;
use Laventure\Component\Database\Schema\SchemaInterface;

class Version202302281534 extends Migration
{
    /**
     * @inheritDoc
    */
    public function up(SchemaInterface $schema): void
    {
        $schema->create('cart', function (Blueprint $table) {
            $table->integer('id')->primary()->increment();
            $table->string('title');
        });
    }



    /**
     * @inheritDoc
    */
    public function down(SchemaInterface $schema): void
    {
        $schema->dropIfExists('cart');
    }
}
