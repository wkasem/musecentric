<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateNewTeachTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('teaches', function (Blueprint $table) {
          $table->increments('id');
          $table->string('user_id');
          $table->string('title');
          $table->string('date');
          $table->integer('budget');
          $table->string('location');
          $table->string('type');
          $table->longText('summary');
          $table->string('benefits');
          $table->string('attachments');
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
        Schema::dropIfExists('teaches');
    }
}
