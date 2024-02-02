<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDoorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('doors', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id');
            $table->string('title');
            $table->string('time');
            $table->text('topic');
            $table->string('status');
            $table->string('grops');
            $table->string('city');
            $table->string('img');
            $table->string('subgrops');
            $table->integer('count')->default(0);
            $table->bigInteger('price')->default(0);
            $table->bigInteger('sort')->default(1);
            $table->bigInteger('password')->default(null);
            $table->boolean('messegeBlock')->default(0);

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('doors');
    }
}
