<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('username');
            $table->string('phon')->unique();
            $table->string('password');
            $table->string('image');
            $table->text("status_door");
            $table->text("rejectDoorMesseg");
            $table->integer("score")->default(0);
            $table->boolean("all_city")->default(0);
            $table->boolean("other_city")->default(0);
            $table->json("doors_see")->nullable;
            $table->json("saveDoor")->nullable;
            $table->json("block");
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
