<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('tags')) {
            Schema::create('tag', function (Blueprint $table) {
                $table->increments('id');
                $table->string('title', 32);
                $table->integer('sort');
                $table->softDeletes();
                $table->timestamps();
                #索引
                $table->unique('title');
                $table->index('sort');
            });
        }

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tag');
    }
}
