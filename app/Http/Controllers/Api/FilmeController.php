<?php

namespace App\Http\Controllers\Api;

use App\Filme;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class FilmeController extends Controller
{
	public function __construct(Filme $filme)
	{
		$this->filme = $filme;
	}

	public function index()
	{
		$data = ['data' => $this->filme->paginate(5)];
		return response()->json($data);
	}

	public function show($id)
	{
		$filme = $this->filme->find($id);

		if(! $filme) return response()->json(ApiError::errorMessage('Filme não encontrado!', 4040), 404);
		
		$data = ['data' => $filme];
		return response()->json($data);
	}

	public function store(Request $request)
	{
		try {
			$filmeData = $request->all();
			$this->filme->create($filmeData);

			$return = ['data' => ['msg' => 'Filme cadastrado com sucesso!']];
			return response()->json($return, 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1010), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao salvar esse filme', 1010), 500);
		}
	}

	public function update(Request $request, $id)
	{
		try {
			$filmeData = $request->all();
			$filme = $this->filme->find($id);
			$filme->update($filmeData);

			$return = ['data' => ['msg' => 'Filme atualizado com sucesso!']];
			return response()->json($return, 201);

		} catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1011), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao atualizar esse filme', 1011), 500);
		}
	}

	public function delete(Filme $id) {
		try {
			$id->delete();

			return response()->json(['data' => ['msg' => 'Filme: ' . $id->nome . 'removido com sucesso!']], 200);

		}catch (\Exception $e) {
			if(config('app.debug')) {
				return response()->json(ApiError::errorMessage($e->getMessage(), 1012), 500);
			}
			return response()->json(ApiError::errorMessage('Houve um erro ao remover esse filme', 1012), 500);

			}
		}
}