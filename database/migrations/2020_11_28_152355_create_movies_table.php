<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->boolean('adult');
            $table->string('backdrop_path')->nullable();
            $table->string('homepage')->nullable();
            $table->integer('external_id')->unique();
            $table->string('imdb_id');
            $table->string('original_language');
            $table->string('original_title');
            $table->text('overview');
            $table->string('popularity');
            $table->date('release_date');
            $table->integer('runtime');
            $table->string('status');
            $table->string('tagline');
            $table->string('title');
            $table->boolean('video');
            $table->integer('vote_count');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
