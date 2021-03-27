<?php

namespace App\Http\Controllers;

use Dotenv\Validator;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class Movie extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index(): Response
    {
        return response(\App\Models\Movie::all());
    }

    public function favoriteAttach(Request $request): Response
    {
        $v = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'movie_id' =>  'required|integer|gt:0'
        ]);
        if ($v->fails()) {
            return \response($v->errors(), 400);
        }
       $request->user()->movies()->attach($request->movie_id);
       return \response(["message" => "Movie has been successfully attached"], 201);
    }

    public function favoriteDetach(Request $request): Response
    {
        $v = \Illuminate\Support\Facades\Validator::make($request->all(), [
            'movie_id' =>  'required|integer|gt:0'
        ]);
        if ($v->fails()) {
            return \response($v->errors(), 400);
        }
        $request->user()->movies()->detach($request->movie_id);
        return \response(["message" => "Movie has been successfully detached"], 201);
    }

    public function favoriteGet(Request $request): Response
    {
        return \response($request->user()->movies()->get()->makeHidden(['pivot']));
    }
}
