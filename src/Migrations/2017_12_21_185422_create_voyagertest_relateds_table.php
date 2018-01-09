<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoyagertestRelatedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voyagertest_relateds', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title',256);
			$table->string('image', 512)->nullable();
			$table->string('summary', 256)->nullable();
			$table->string('description', 2048)->nullable();
            $table->integer('voyagertest_id')->unsigned()->index();
			$table->foreign('voyagertest_id')->references('id')->on('voyagertests')->onDelete('cascade');
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
        Schema::dropIfExists('voyagertest_relateds');
    }
}
