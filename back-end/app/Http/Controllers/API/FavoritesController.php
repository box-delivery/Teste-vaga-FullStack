<?php


namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\CreateFavoritesRequest;
use App\Models\Favorites;
use App\Models\Movie;

class FavoritesController extends Controller
{

    /**
     * Returns all favorites - paginated
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function index()
    {
        $favorites = Favorites::where('user_id', auth()->id())
            ->with('movie')
            ->paginate(10);
        return response()->json($favorites, 200);
    }


    /**
     * @param CreateFavoritesRequest $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(CreateFavoritesRequest $request)
    {
        try {
            # Check if movie exists
            $movie = Movie::find($request->movie_id);
            if (!$movie) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Movie not found.'
                    ]
                );
            }

            # Check if movie is in favorites
            $favorites = Favorites::where('movie_id', $request->movie_id)
                ->where('user_id', auth()->id())->first();
            if ($favorites) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Movie already registered as a favorite.'
                    ]
                );
            }
            # add favorites
            Favorites::create(
                [
                    'user_id' => auth()->id(),
                    'movie_id' => $request->movie_id
                ]
            );

            return response()->json(
                [
                    'success' => true,
                    'message' => 'Registered successfully.'
                ]
            );
        } catch (\Exception $e) {
            return response()->json(
                [
                    'success' => false,
                    'message' => $e->getMessage()
                ]
            );
        }
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        try {
            $favorite = Favorites::find($id);
            if (!$favorite) {
                return response()->json(
                    [
                        'success' => false,
                        'message' => 'Movie not found in favorites.'
                    ]
                );
            }
            # deleted movie from favorites
            $favorite->delete();
            return response()->json([
                "success" => true,
                "message" => 'Movie successfully deleted from favorites',
            ]);
        } catch (\Exception $e) {
            return response()->json([
                "success" => false,
                "message" => $e->getMessage(),
            ]);
        }
    }
}
