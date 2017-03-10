<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function(Blueprint $table) {
            $table->timestamps();
            $table->increments('id');
            $table->string('slug');
            $table->string('menu_text');
            $table->string('title');
            $table->text('content');
        });

        Schema::create('metas', function(Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('value');
            $table->integer('metable_id');
            $table->string('metable_type');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
        Schema::drop('metas');
    }
}
