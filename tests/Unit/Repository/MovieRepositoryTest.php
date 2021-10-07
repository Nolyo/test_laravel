<?php

namespace Tests\Unit\Repository;

use App\Http\Requests\Movie\MovieStoreRequest;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Models\Movie;
use App\Repository\MovieRepository;
use Tests\TestCase;


class MovieRepositoryTest extends TestCase
{

    public function testAll(): void
    {
        $repo = new MovieRepository();
        $allMovie = $repo->all();
        $this->assertCount(5, $allMovie);
    }

    public function testStore()
    {
        $mock = $this->createMock(MovieStoreRequest::class);
        $repo = new MovieRepository();
        $expectedName = "I am a new movie";
        $expectedSynopsis = "This movie is the best";
        $mock->expects($this->once())->method('all')->willReturn(['title' => $expectedName, 'synopsis' => $expectedSynopsis]);
        $repo->store($mock);
        $movie = Movie::latest()->first();
        $this->assertSame($expectedName, $movie->title);
        $this->assertSame($expectedSynopsis, $movie->synopsis);
        $repo->delete($movie);
    }

    public function testDelete()
    {
        $repo = new MovieRepository();

        $allMovie = $repo->all();
        $this->assertCount(5, $allMovie);

        $movie = Movie::create([
            'title' => 'Title movie by repo',
            'synopsis' => 'Synopsis By repo'
        ]);

        $allMovie = $repo->all();
        $this->assertCount(6, $allMovie);

        $repo->delete($movie);
        $allMovie = $repo->all();

        $this->assertCount(5, $allMovie);
    }

    public function testShow()
    {
        $repo = new MovieRepository();
        $movie = $repo->show(Movie::find(1));
        $this->assertNotEmpty($movie);
        $this->assertCount(3, $movie->actors);
    }

    public function testUpdate()
    {
        $mock = $this->createMock(MovieUpdateRequest::class);
        $repo = new MovieRepository();
        $expectedName = "It s my new name";
        $expectedSynopsis = "This is the worst movie in the world";

        $movie = Movie::find(1);
        $mock->expects($this->once())->method('all')->willReturn(['title' => $expectedName, 'synopsis' => $expectedSynopsis]);
        $repo->update($mock, $movie);
        $this->assertSame($expectedName, $movie->title);
        $this->assertSame($expectedSynopsis, $movie->synopsis);
    }
}
