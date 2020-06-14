<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlayProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('play_products', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->string('inout');
            $table->string('category');
            $table->string('kanji_name');
            $table->string('display_name');
            $table->string('image_url');
            $table->string('refe_link')->nullable();
            $table->string('youtube_video_Id')->nullable();
            $table->string('tool_tags')->nullable();

            $table->unsignedTinyInteger('recommend_min_age');
            $table->unsignedTinyInteger('recommend_max_age');
            $table->unsignedTinyInteger('time_minutes');
            $table->text('description');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('play_products');
    }
}
