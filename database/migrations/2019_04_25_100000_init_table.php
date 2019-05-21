<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class InitTable extends Migration
{
    public function up()
    {

        Schema::create('Field', function($table) {
            $table->increments('id');
            $table->string('name');
            $table->string('label');
            $table->enum('fieldType', ['BASIC', 'FIXED', 'FOREIGN', 'STATIC']);
            $table->timestamps();
        });

        Schema::create('Entity', function($table) {
            $table->increments('id');
            $table->timestamps();
        });


        Schema::create('Value', function($table) {
            $table->increments('id');
            $table->integer('field_id')->unsigned();
            $table->integer('entity_id')->unsigned();
            $table->text('value');
            $table->timestamps();
        });
    }

    public function down() { }
}
