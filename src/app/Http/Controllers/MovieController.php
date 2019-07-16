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

    public function getComments(int $movieId)
    {
        $movies = $this->movieService->getComments($movieId);
        return Response::success($movies, 'Successfully fetched movies');
    }
}
