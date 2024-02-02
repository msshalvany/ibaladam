<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInfowebsitesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('infowebsites', function (Blueprint $table) {
            $table->id();
            $table->text('wordEore');
            $table->text('rols');
            $table->text('keyWord');
            $table->text('info');
            $table->string('instagram');
            $table->string('telegram');
            $table->string('suporter');
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
        Schema::dropIfExists('infowebsites');
    }
}
