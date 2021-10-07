<?php

namespace App\Repository;

use App\Http\Requests\Actor\ActorStoreRequest;
use App\Models\Actor;
use Illuminate\Database\Eloquent\Collection;

class ActorRepository {

    public function all(): Collection
    {
        return Actor::all()->load('movies');
    }

    public function store(ActorStoreRequest $request): void
    {
        Actor::create($request->all());
    }

    public function show(Actor $actor): Actor
    {
        return $actor->load('movies');
    }

    public function update(ActorStoreRequest $request, Actor $actor): void
    {
        $actor->update($request->all());
    }

    public function delete(Actor $actor): void
    {
        $actor->delete();
    }
}
