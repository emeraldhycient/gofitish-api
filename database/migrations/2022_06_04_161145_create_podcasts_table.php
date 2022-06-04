<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('podcasts', function (Blueprint $table) {
            $table->id();
            $table->string('podcast_id')->unique();
            $table->text('title');
            $table->longText('description');
            $table->string('podcast_url');
            $table->string('poster_url');
            $table->string('podcast_category');
            $table->string('podcast_subcategory')->nullable();
            $table->string('podcast_tags')->nullable();
            $table->string('uploader_id');
            $table->string('uploader_name');
            $table->integer('views')->default(0);
            $table->integer('likes')->default(0);
            $table->integer('dislikes')->default(0);
            $table->integer('comments')->default(0);
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
        Schema::dropIfExists('podcasts');
    }
};