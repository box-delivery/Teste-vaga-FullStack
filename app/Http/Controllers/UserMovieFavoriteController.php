<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class UserMovieFavoriteController extends Controller
{
    public function index(Request $request)
    {
        return $request->user()
            ->favoriteMovies()
            ->paginate();
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => ['required', 'exists:movies,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        if ($request->user()->favoriteMovies()->where($validator->validated())->exists()) {
            return response()->json(['msg' => 'movie has already been added to favorites']);
        }

        $request->user()->favoriteMovies()->attach($validator->validated());

        return response()->json(['msg' => 'movie added to favorites']);
    }

    public function destroy(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'movie_id' => ['required', 'exists:movies,id'],
        ]);

        if ($validator->fails()) {
            return response()->json($validator->messages(), 200);
        }

        $movieQB = $request->user()->favoriteMovies()->where($request->only('movie_id'));
        if ($movieQB->exists()) {
            $movieQB->detach();
            return response()->json(['msg' => 'movie removed from favorites']);
        }

        return response()->json(['msg' => 'movie has already been removed from favorites']);
    }

}
