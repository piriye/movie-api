<?php

namespace App\Http\Controllers;

use App\Services\MovieService;
use App\Helpers\ResponseHelper as Response;
use App\Utilities\ErrorCode;
use App\Utilities\MovieApiException;

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
        try {
            $movies = $this->movieService->getComments($movieId);
            return Response::success($movies, 'Successfully fetched comments');
        } catch (MovieApiException $ex) {
            return Response::error($ex->getMessage(), ErrorCode::BAD_REQUEST);
        }
    }
}
