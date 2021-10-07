<?php

namespace App\Repository;

use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Models\Movie;
use Illuminate\Database\Eloquent\Collection;

class MovieRepository {

    public function all(): Collection
    {
        return Movie::all()->load('actors');
    }

    public function store(MovieStoreRequest $request): void
    {
        Movie::create($request->all());
    }

    public function show(Movie $movie): Movie
    {
        return $movie->load('actors');
    }

    public function update(MovieUpdateRequest $request, Movie $movie): void
    {
        $movie->update($request->all());
    }

    public function delete(Movie $movie): void
    {
        $movie->delete();
    }
}
