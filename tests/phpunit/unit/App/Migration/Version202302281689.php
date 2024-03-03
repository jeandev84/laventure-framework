<?php

namespace PHPUnitTest\App\Migration;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Migration\Migration;
use Laventure\Component\Database\Schema\SchemaInterface;

class Version202302281689 extends Migration
{
    /**
     * @inheritDoc
   */
    public function up(SchemaInterface $schema): void
    {
        $schema->create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username', 150);
            $table->string('email', 180);
            $table->string('password', 230);
            $table->boolean('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
            $table->unique(['email']);
        });

    }



    /**
     * @inheritDoc
    */
    public function down(SchemaInterface $schema): void
    {
        $schema->dropIfExists('users');
    }
}
