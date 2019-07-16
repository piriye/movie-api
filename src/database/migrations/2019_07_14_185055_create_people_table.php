<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name', 80);
            $table->float('height', 8, 2)->nullable();
            $table->float('mass', 8, 2)->nullable();
            $table->string('hair_color', 20);
            $table->string('skin_color', 20);
            $table->string('eye_color', 20);
            $table->string('birth_year', 20);
            $table->string('gender', 20);
            $table->string('homeworld', 255);
            $table->date('created');
            $table->date('edited');
            $table->string('url', 255)->unique();
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
        Schema::dropIfExists('people');
    }
}
