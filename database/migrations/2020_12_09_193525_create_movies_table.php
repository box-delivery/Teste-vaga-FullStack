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
            $table->id();

            $table->bigInteger("themoviedb_id");

            $table->boolean("adult")->nullable();
            $table->string("backdrop_path")->nullable();
            $table->string("original_language")->nullable();
            $table->string("original_title")->nullable();
            $table->longText("overview")->nullable();
            $table->decimal("popularity")->nullable();
            $table->string("poster_path")->nullable();
            $table->string("release_date")->nullable();
            $table->string("title")->nullable();
            $table->string("video")->nullable();
            $table->decimal("vote_average")->nullable();
            $table->integer("vote_count")->nullable();

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
        Schema::dropIfExists('movies');
    }
}
