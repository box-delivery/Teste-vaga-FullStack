<?php

namespace Tests\Feature;

use App\Models\Favorites;
use App\Models\Movie;
use App\Models\User;
use Tests\TestCase;

class FavoriteTest extends TestCase
{
    public function testAddFavorite()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user);

        $movie = factory(Movie::class)->create([
            "codigo" => 284054,
            "title" => 'Pantera Negra',
            "original_title" => 'Black Panther',
            "overview" => "Após a morte do Rei T'Chaka, o príncipe T'Challa retorna a Wakanda para a cerimônia de coroação. Nela são reunidas as cinco tribos que compõem o reino, sendo que uma delas, os Jabari, não apoia o atual governo. T'Challa logo recebe o apoio de Okoye, a chefe da guarda de Wakanda, da irmã Shuri, que coordena a área tecnológica do reino, e também de Nakia, a grande paixão do atual Pantera Negra, que não quer se tornar rainha. Juntos, eles estão à procura de Ulysses Klaue, que roubou de Wakanda um punhado de vibranium, alguns anos atrás.",
            "poster_path" => '/2yQUnpc1BXgesJrfcdoRa6jTAnA.jpg'
        ]);

        $favoriteData = [
          'user_id' => $user->id,
          'movie_id' => $movie->id
        ];

        $this->json('POST', 'api/favorites/store', $favoriteData, ['Accept' => 'application/json'])
            ->assertStatus(200);
    }

    public function testDeleteFavorite()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user, 'api');

        $movie = factory(Movie::class)->create([
            "codigo" => 284054,
            "title" => 'Pantera Negra',
            "original_title" => 'Black Panther',
            "overview" => "Após a morte do Rei T'Chaka, o príncipe T'Challa retorna a Wakanda para a cerimônia de coroação. Nela são reunidas as cinco tribos que compõem o reino, sendo que uma delas, os Jabari, não apoia o atual governo. T'Challa logo recebe o apoio de Okoye, a chefe da guarda de Wakanda, da irmã Shuri, que coordena a área tecnológica do reino, e também de Nakia, a grande paixão do atual Pantera Negra, que não quer se tornar rainha. Juntos, eles estão à procura de Ulysses Klaue, que roubou de Wakanda um punhado de vibranium, alguns anos atrás.",
            "poster_path" => '/2yQUnpc1BXgesJrfcdoRa6jTAnA.jpg'
        ]);

        $favorite = Favorites::create([
            "user_id" => $user->id,
            "movie_id" => $movie->id,
        ]);

        $this->json('DELETE', 'api/favorites/destroy/'.$favorite->id, [], ['Accept' => 'application/json'])
            ->assertStatus(200);
    }
}
