<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\MovieService;
use App\Helpers\ResponseHelper as Response;

class MovieController extends Controller
{
    private $movieService;
    
    public function __construct(MovieService $movieService)
    {
        $this->movieService = $movieService;
    }

    public function getMovieList()
    {
        $movies = $this->movieService->getMovies();
        return Response::success($movies, 'Successfully fetched movies');
    }

    public function getMovieCharacters(Request $request, int $movieId)
    {
        $characters = $this->movieService->getMovieCharacters($movieId, $request->all());
    }
}
