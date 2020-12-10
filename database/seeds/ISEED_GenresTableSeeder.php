<?php

use Illuminate\Database\Seeder;

class ISEED_GenresTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('genres')->delete();
        
        \DB::table('genres')->insert(array (
            0 => 
            array (
                'id' => 1,
                'themoviedb_id' => 28,
                'name' => 'Ação',
                'description' => 'Gênero Ação, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            1 => 
            array (
                'id' => 2,
                'themoviedb_id' => 12,
                'name' => 'Aventura',
                'description' => 'Gênero Aventura, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            2 => 
            array (
                'id' => 3,
                'themoviedb_id' => 16,
                'name' => 'Animação',
                'description' => 'Gênero Animação, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            3 => 
            array (
                'id' => 4,
                'themoviedb_id' => 35,
                'name' => 'Comédia',
                'description' => 'Gênero Comédia, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            4 => 
            array (
                'id' => 5,
                'themoviedb_id' => 80,
                'name' => 'Crime',
                'description' => 'Gênero Crime, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            5 => 
            array (
                'id' => 6,
                'themoviedb_id' => 99,
                'name' => 'Documentário',
                'description' => 'Gênero Documentário, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            6 => 
            array (
                'id' => 7,
                'themoviedb_id' => 18,
                'name' => 'Drama',
                'description' => 'Gênero Drama, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            7 => 
            array (
                'id' => 8,
                'themoviedb_id' => 10751,
                'name' => 'Família',
                'description' => 'Gênero Família, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            8 => 
            array (
                'id' => 9,
                'themoviedb_id' => 14,
                'name' => 'Fantasia',
                'description' => 'Gênero Fantasia, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            9 => 
            array (
                'id' => 10,
                'themoviedb_id' => 36,
                'name' => 'História',
                'description' => 'Gênero História, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            10 => 
            array (
                'id' => 11,
                'themoviedb_id' => 27,
                'name' => 'Terror',
                'description' => 'Gênero Terror, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            11 => 
            array (
                'id' => 12,
                'themoviedb_id' => 10402,
                'name' => 'Música',
                'description' => 'Gênero Música, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            12 => 
            array (
                'id' => 13,
                'themoviedb_id' => 9648,
                'name' => 'Mistério',
                'description' => 'Gênero Mistério, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            13 => 
            array (
                'id' => 14,
                'themoviedb_id' => 10749,
                'name' => 'Romance',
                'description' => 'Gênero Romance, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            14 => 
            array (
                'id' => 15,
                'themoviedb_id' => 878,
                'name' => 'Ficção científica',
                'description' => 'Gênero Ficção científica, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            15 => 
            array (
                'id' => 16,
                'themoviedb_id' => 10770,
                'name' => 'Cinema TV',
                'description' => 'Gênero Cinema TV, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            16 => 
            array (
                'id' => 17,
                'themoviedb_id' => 53,
                'name' => 'Thriller',
                'description' => 'Gênero Thriller, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            17 => 
            array (
                'id' => 18,
                'themoviedb_id' => 10752,
                'name' => 'Guerra',
                'description' => 'Gênero Guerra, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
            18 => 
            array (
                'id' => 19,
                'themoviedb_id' => 37,
                'name' => 'Faroeste',
                'description' => 'Gênero Faroeste, criado apartir da API themoviedb',
                'created_at' => '2020-12-09 20:54:48',
                'updated_at' => '2020-12-09 20:54:48',
            ),
        ));
        
        
    }
}