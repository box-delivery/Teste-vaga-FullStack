<?php

namespace App\Domain\Movies\Controllers;

use App\Http\Controllers\Controller;
use Infrastructure\Movies\Repositories\MovieRepository;

class MovieController extends Controller
{
    private MovieRepository $movieRepository;

    public function __construct(MovieRepository $movieRepository)
    {
        $this->movieRepository = $movieRepository;
    }

    public function index()
    {
        return response($this->movieRepository->findAll());
    }
}
