<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('videos', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('slug');
            $table->string('thumbnail_small');
            $table->string('thumbnail_medium');
            $table->string('thumbnail_large');
            $table->string('link');
            $table->integer('vimeo_id');
            $table->integer('duration');
            $table->string('pdf')->nullable();
            $table->text('description')->nullable();;
            $table->timestamps();
        });

        Schema::create('theme_video', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedBigInteger('video_id')->unsigned()->index();
            $table->unsignedBigInteger('theme_id')->unsigned()->index();
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
        Schema::dropIfExists('videos');
    }
}
