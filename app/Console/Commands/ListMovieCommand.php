<?php

namespace App\Console\Commands;

use App\Repository\MovieRepository;
use Illuminate\Console\Command;

class ListMovieCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movie:list {--actors : Get movie actors}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get all Movie in DB';
    /**
     * @var MovieRepository
     */
    private $movieRepository;

    /**
     * Create a new command instance.
     */
    public function __construct(MovieRepository $movieRepository)
    {
        parent::__construct();
        $this->movieRepository = $movieRepository;
    }

    /**
     * Execute the console command.
     */
    public function handle(): void
    {
        $movies = $this->movieRepository->all();
        $actors = $this->option('actors');

        foreach ($movies as $movie) {
            $text = $movie->title;
            if ($actors) {
                $text .= " / Actors: ";
                foreach ($movie->actors as $actor) {
                    $text .= $actor->name .  " ";
                }
            }
            $this->info($text);
        }
    }
}
