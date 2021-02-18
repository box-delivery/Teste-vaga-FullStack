<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Favorites;
use App\Models\Movies;
use App\Traits\ApiResponser;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    
    use ApiResponser;
    
    public function __construct()
    {
        
    }

    public function list(Request $request)
    {
        $user = $request->user();
        $favorites = $user->favorites()->get();
        if (count($favorites) == 0) {
            return $this->error('Nenhum filme favorito',202);
        }
        foreach ($favorites as $favorite) {
            $movies['movies'][] = $favorite->movie()->get(['id', 'title', 'language', 'overview', 'release_date', 'poster_path', 'adult']);
        }
        
        return $this->success($movies,'Lista de favoritos',200);
    }

    public function toggle(Request $request)
    {
        if (empty($request->input('movie_id'))) {
            return $this->error('Não foi possível localizar o filme desejado',404);
        }
        $user = $request->user();
        $movie = Movies::find($request->input('movie_id'));

        if (empty($movie)) {
            return $this->error('Não foi possível localizar o filme desejado',404);
        }
        $favorites = Favorites::where([
            ['user_id', '=', $user->id],
            ['movie_id', '=', $movie->id]
        ])->first();
        
        if ($favorites == null) {
            Favorites::create([
                'user_id' => $user->id,
                'movie_id' => $movie->id,
                'is_favorite' => 1
            ]);

            return $this->success([],'Filme adicionado aos favoritos com Sucesso',200);
        }
        
        $isFavorite = !$favorites->is_favorite;
        
        $favorites->update([
            'is_favorite' => $isFavorite
        ]);

        if ($isFavorite) {
            return $this->success([],'Filme adicionado aos favoritos com Sucesso',200);
        }
        
        return $this->success([],'Filme removido dos favoritos com Sucesso',200);
    }
}
