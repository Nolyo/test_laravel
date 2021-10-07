<?php

namespace Tests\Unit\Http\Controllers;

use App\Http\Controllers\Api\MovieController;
use App\Http\Requests\Movie\MovieUpdateRequest;
use App\Models\Movie;
use App\Repository\ActorRepository;
use App\Repository\MovieRepository;
use Illuminate\Database\Eloquent\Collection;
use Tests\TestCase;


class MovieControllerTest extends TestCase
{

    public function testIndex()
    {
        $controller = new MovieController();

        $mock = $this->createMock(MovieRepository::class);
        $movie = $this->getMockMovie();

        $mock->expects($this->once())->method('all')->willReturn(new Collection([$movie]));
        $index = $controller->index($mock);

        $this->assertSame($index[0]->title, 'title 1');
    }

    public function testStatusIndex()
    {
        $response = $this->get('/api/movies');

        $response->assertStatus(200);
    }

    /**
     * TODO: WIP
     */
    public function testDeleteMovie()
    {
        $controller = new MovieController();

        $movie = $this->getMockMovie();
        $mockMovieRepo = $this->createMock(MovieRepository::class);
        $mockMovieRepo->expects($this->once())->method('delete');
        $controller->destroy($mockMovieRepo, $movie);

    }

    public function testUpdate()
    {
        $controller = new MovieController();

        $movie = $this->getMockMovie();
        $mockMovieRepo = $this->createMock(MovieRepository::class);
        $mockMovieReq = $this->createMock(MovieUpdateRequest::class);
        $mockMovieRepo->expects($this->once())->method('update');
        $controller->update($mockMovieReq, $mockMovieRepo, $movie);

    }

    public function testStatusShow()
    {
        $response = $this->get('/api/movies/1');

        $response->assertStatus(200);
    }

    public function getMockMovie(): Movie
    {
        return new Movie([
            'title' => 'title 1',
            'synopsis' => 'tralala lala'
        ]);
    }
}
