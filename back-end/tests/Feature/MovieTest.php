<?php

namespace Tests\Feature;

use App\Models\Movie;
use App\Models\User;
use Tests\TestCase;
use JWTAuth;

class MovieTest extends TestCase
{
    public function testMovieListedSuccessfully()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        factory(Movie::class)->create([
            "codigo" => 284054,
            "title" => 'Pantera Negra',
            "original_title" => 'Black Panther',
            "overview" => "Após a morte do Rei T'Chaka, o príncipe T'Challa retorna a Wakanda para a cerimônia de coroação. Nela são reunidas as cinco tribos que compõem o reino, sendo que uma delas, os Jabari, não apoia o atual governo. T'Challa logo recebe o apoio de Okoye, a chefe da guarda de Wakanda, da irmã Shuri, que coordena a área tecnológica do reino, e também de Nakia, a grande paixão do atual Pantera Negra, que não quer se tornar rainha. Juntos, eles estão à procura de Ulysses Klaue, que roubou de Wakanda um punhado de vibranium, alguns anos atrás.",
            "poster_path" => '/2yQUnpc1BXgesJrfcdoRa6jTAnA.jpg'
        ]);

        factory(Movie::class)->create([
            "codigo" => 505642,
            "title" => 'Pantera Negra 2',
            "original_title" => 'Black Panther II',
            "overview" => "Sequência do filme Pantera Negra, já confirmado pela Marvel Studios, mas ainda sem data de lançamento (provável lançamento para 2020).",
            "poster_path" => '/9kv13NQCzeb6zCS001B9JY6St14.jpg'
        ]);

        $this->json('GET', 'api/movies', ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
