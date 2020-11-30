<?php

namespace Infrastructure\Movies\Repositories;

use Domain\Movies\Movie;
use Illuminate\Database\Eloquent\Model;
use Infrastructure\Shared\Repositories\AbstractRepository;

class MovieRepository extends AbstractRepository
{
    public function __construct(Movie $movie)
    {
        $this->model = $movie;
    }

    public function findByExternalId(int $id): ?Movie
    {
        return $this->model->where('external_id', $id)->first();
    }
}