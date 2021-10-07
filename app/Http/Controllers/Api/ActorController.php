<?php

namespace App\Http\Controllers\Api;

use App\Http\Requests\Actor\ActorStoreRequest;
use App\Models\Actor;
use App\Repository\ActorRepository;
use Illuminate\Database\Eloquent\Collection;
use App\Http\Controllers\Controller;


class ActorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(ActorRepository $actorRepository): Collection
    {
        return $actorRepository->all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ActorRepository $actorRepository, ActorStoreRequest $request): void
    {
        $actorRepository->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(ActorRepository $actorRepository, Actor $actor): Actor
    {
        return $actorRepository->show($actor);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(ActorRepository $actorRepository, ActorStoreRequest $request, Actor $actor): void
    {
        $actorRepository->update($request, $actor);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ActorRepository $actorRepository, Actor $actor): void
    {
        $actorRepository->delete($actor);
    }
}
