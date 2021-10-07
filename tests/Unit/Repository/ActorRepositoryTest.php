<?php

namespace Tests\Unit\Repository;

use App\Http\Requests\Actor\ActorStoreRequest;
use App\Models\Actor;
use App\Repository\ActorRepository;
use Tests\TestCase;


class ActorRepositoryTest extends TestCase
{

    public function testAll(): void
    {
        $repo = new ActorRepository();
        $allMovie = $repo->all();
        $this->assertCount(25, $allMovie);
    }

    public function testUpdate()
    {
        $mock = $this->createMock(ActorStoreRequest::class);
        $repo = new ActorRepository();
        $expectedName = "It s my new name";
        $actor = Actor::find(1);
        $mock->expects($this->once())->method('all')->willReturn(['name' => $expectedName]);
        $repo->update($mock, $actor);
        $this->assertSame($expectedName, $actor->name);
    }

    public function testStore()
    {
        $mock = $this->createMock(ActorStoreRequest::class);
        $repo = new ActorRepository();
        $expectedName = "I am a new actor";
        $mock->expects($this->once())->method('all')->willReturn(['name' => $expectedName]);
        $repo->store($mock);
        $actor = Actor::latest()->first();
        $this->assertSame($expectedName, $actor->name);
        $repo->delete($actor);
    }

    public function testDelete()
    {
        $repo = new ActorRepository();

        $actors = $repo->all();
        $this->assertCount(25, $actors);

        $actor = Actor::create(['name' => 'Yohann JAFFRES']);

        $actors = $repo->all();
        $this->assertCount(26, $actors);

        $repo->delete($actor);
        $actors = $repo->all();

        $this->assertCount(25, $actors);
    }

    public function testShow()
    {
        $repo = new ActorRepository();
        $actor = $repo->show(Actor::find(1));
        $actor2 = $repo->show(Actor::find(11));

        $this->assertNotEmpty($actor);
        $this->assertCount(0, $actor->movies);

        $this->assertNotEmpty($actor2);
        $this->assertCount(1, $actor2->movies);
    }

    /*public function testUpdate()
    {
        $repo = new MovieRepository();
        $movie = Movie::find(1);
        $originalTitle = $movie->title;
        $this->assertNotEmpty($originalTitle);
        $mockRequest = $this->createMock('MovieUpdateRequest');
        $repo->update();
    }*/
}
