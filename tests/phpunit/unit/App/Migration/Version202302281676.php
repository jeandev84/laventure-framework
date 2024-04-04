<?php

declare(strict_types=1);

namespace PHPUnitTest\App\Migration;

use Laventure\Component\Database\Schema\Blueprint\Blueprint;
use Laventure\Component\Database\Schema\Migration\Migration;
use Laventure\Component\Database\Schema\SchemaInterface;

class Version202302281676 extends Migration
{
    /**
     * @inheritDoc
    */
    public function up(SchemaInterface $schema): void
    {
        $schema->create('categories', function (Blueprint $table) {
            $table->integer('id')->primary()->increment();
            $table->string('title');
        });
    }




    /**
     * @inheritDoc
    */
    public function down(SchemaInterface $schema): void
    {
        $schema->dropIfExists('categories');
    }
}
