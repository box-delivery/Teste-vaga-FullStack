<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies_genres', function (Blueprint $table) {
            $table->id();

            $table->bigInteger("themoviedb_genre_id")->nullable();
           /* $table->foreign("themoviedb_genre_id")
                ->references("themoviedb_id")
                ->on("genres")
                ->onDelete("cascade");*/

            $table->bigInteger("themoviedb_movie_id")->nullable();
           /* $table->foreign("themoviedb_movie_id")
                ->references("themoviedb_id")
                ->on("movies")
                ->onDelete("cascade");*/

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
        Schema::dropIfExists('movies_genres');
    }
}
