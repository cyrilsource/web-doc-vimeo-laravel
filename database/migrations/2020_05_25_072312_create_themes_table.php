<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateThemesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('themes', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('slug');
            $table->string('thumbnail');
            $table->string('pdf');
            $table->text('description');
            $table->timestamps();
        });

        Schema::create('video_theme', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('video_id')->unsigned()->index();
            $table->integer('theme_id')->unsigned()->index();
            $table->foreign('video_id')->references('id')->on('videos')->onDelete('cascade');
            $table->foreign('theme_id')->references('id')->on('themes')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('themes');
    }
}
