<?php declare(strict_types=1);

namespace App\Console\Commands;

use App\Utilities\Utils;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;
use App\Helpers\HttpRequestHelper;
use App\Models\Person;
use App\Services\MovieService;
use App\Services\PersonService;

class FetchMovies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'movies:fetch';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Fetch movies';

    private $httpRequestHelper;
    private $keyMappings;
    private $person;
    private $movieService;
    private $personService;

    /**
     * Create a new command instance.
     *
     * @param HttpRequestHelper $httpRequestHelper
     * @param Person $person
     * @param MovieService $movieService
     * @param PersonService $personService
     */
    public function __construct(
        HttpRequestHelper $httpRequestHelper,
        Person $person,
        MovieService $movieService,
        PersonService $personService
    ) {
        parent::__construct();
        $this->httpRequestHelper = $httpRequestHelper;
        $this->person = $person;
        $this->movieService = $movieService;
        $this->personService = $personService;

        $this->keyMappings = [
            'characters' => $this->person,
        ];
    }

    /**
     * Execute the console command.
     *
     * @throws \Exception
     */
    public function handle()
    {
        $url = 'https://swapi.co/api/films';

        Log::info('fetching movies from ' . $url);

        $response = $this->httpRequestHelper->sendGetRequest($url);
        $movies = $response['results'];

        foreach ($movies as $movie) {
            try {
                $fieldsToExclude = ['characters', 'planets', 'starships', 'vehicles', 'species'];

                $movieData = $movie;

                $movieData = Utils::arrayExclude($movieData, $fieldsToExclude);

                $movieObject = $this->movieService->createMovie($movieData);

                $characters = $movie['characters'];

                $this->attachMoviesToCharacters($movieObject, $characters);
            } catch (\Exception $ex) {
                Log::error('error occurred while fetching movies for : \n' . $ex->getMessage());
            }
        }

        return $movies;
    }

    public function attachMoviesToCharacters($movie, $characters)
    {
        foreach ($characters as $character) {
            try {
                $response = $this->httpRequestHelper->sendGetRequest($character);

                $fieldsToExclude = ['films', 'species', 'vehicles', 'starships'];

                $personData = Utils::arrayExclude($response, $fieldsToExclude);

                $characterObject = $this->personService->createPerson($personData);

                $movie->people()->attach($characterObject->id);
            } catch (\Exception $ex) {
                Log::error('error occurred while fetching character for : \n' . $ex->getMessage());
            }
        }
    }
}
