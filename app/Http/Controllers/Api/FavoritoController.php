<?php

namespace App\Http\Controllers\Api;

use App\Favorito;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FavoritoController extends Controller
{
	public function __construct(Favorito $favorito)
	{
		$this->favorito = $favorito;
	}

	public function index()
	{
		$id = auth()->user()->id;
		$favoritos = Favorito::with('filme','user')->where('user_id', $id)->paginate(5);

		$data = ['data' => $favoritos];
		return response()->json($data);
	}

	public function show($id)
	{
		//
	}

	public function store(Request $request)
	{
		try {
			$favoritoData = new Favorito();
			$favoritoData->filme_id = $request->input('filme_id');
        	$favoritoData->user_id = auth()->user()->id;
			$favoritoData->save();

			$return = ['data' => ['msg' => 'Filme cadastrado com sucesso como favorito!']];
			return response()->json($return, 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao salvar esse filme como favorito', 1010), 500);
		}
	}

	public function update(Request $request, $id)
	{
		//
	}

	public function delete($id) {
		try {
			$userid = auth()->user()->id;
			$favorito = Favorito::with('filme','user')->where('user_id', $userid)->find($id);
			$favorito->delete();

			$return = ['data' => ['msg' => 'Filme removido da lista de favoritos com sucesso!']];
			return response()->json($return, 200);

		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao remover esse filme favorito', 1012), 500);

			}
		}
}