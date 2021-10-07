<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Models\Movie;
use App\Repository\MovieRepository;
use Illuminate\Database\Eloquent\Collection;

class MovieController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(MovieRepository $movieRepository): Collection
    {
        return $movieRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(MovieRepository $movieRepository, MovieStoreRequest $request)
    {
        $movieRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(MovieRepository $movieRepository, Movie $movie): Movie
    {
        return $movieRepository->show($movie);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(MovieUpdateRequest $request, MovieRepository $movieRepository, Movie $movie): void
    {
        $movieRepository->update($request, $movie);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(MovieRepository $movieRepository, Movie $movie): void
    {
        $movieRepository->delete($movie);
    }
}
