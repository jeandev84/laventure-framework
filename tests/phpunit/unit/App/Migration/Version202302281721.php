<?php

namespace PHPUnitTest\App\Migration;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Migration\Migration;
use Laventure\Component\Database\Schema\SchemaInterface;

class Version202302281721 extends Migration
{
    /**
     * @inheritDoc
   */
    public function up(SchemaInterface $schema): void
    {
        $schema->create('goods', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 200);
            $table->string('slug', 300);
            $table->text('description');
            $table->float('price');
            $table->string('image', 200);
            $table->boolean('in_stock')->default(0);
            $table->timestampsNullable();
            $table->softDeletes();
            $table->bigInteger('user_id');
            $table->foreign('user_id')
                  ->references('id')
                  ->on('users')
                  ->onDelete('cascade');
            $table->unique(['slug']);
            $table->index(['title']);
        });

    }



    /**
     * @inheritDoc
    */
    public function down(SchemaInterface $schema): void
    {
        $schema->dropIfExists('goods');
    }
}
