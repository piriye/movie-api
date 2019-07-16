<?php

namespace App\Services;

use App\Helpers\HttpRequestHelper;
use App\Models\Movie;
use App\Utilities\ErrorCode;
use App\Utilities\MovieApiException;
use Carbon\Carbon;
use Illuminate\Database\QueryException;
use Illuminate\Support\Facades\Log;

class MovieService
{
    private $httpRequestHelper;
    private $movie;

    public function __construct(HttpRequestHelper $httpRequestHelper, Movie $movie)
    {
        $this->httpRequestHelper = $httpRequestHelper;
        $this->movie = $movie;
    }

    public function getMovies()
    {
        return $this->movie->getAll();
    }

    /**
     * @param array $params
     * @return mixed
     * @throws MovieApiException
     */
    public function createMovie(array $params)
    {
        Log::info('creating movie - ' . json_encode($params));

        try {
            $params['created'] = Carbon::parse(strtotime($params['created']));
            $params['edited'] = Carbon::parse(strtotime($params['edited']));

            return $this->movie->firstOrCreate($params);
        } catch (QueryException $ex) {
            if ($ex->getCode() == 23000) {
                $errorMsg = 'attempting to create a duplicate movie ' ;
                Log::debug($errorMsg . json_encode($params));
            }

            throw new MovieApiException($ex->getMessage(), ErrorCode::INTERNAL_ERROR);
        }
    }
}
