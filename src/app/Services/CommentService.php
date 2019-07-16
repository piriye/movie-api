<?php

namespace App\Services;

use App\Models\Comment;
use App\Models\Movie;
use App\Utilities\ErrorCode;
use App\Utilities\MovieApiException;

class CommentService
{
    private $comment;
    private $movie;

    public function __construct(Comment $comment, Movie $movie)
    {
        $this->comment = $comment;
        $this->movie = $movie;
    }

    /**
     * @param int $movieId
     * @param array $params
     * @return mixed
     * @throws MovieApiException
     */
    public function createComment(int $movieId, array $params)
    {
        $movie = $this->movie->find($movieId);

        if (empty($movie)) {
            throw new MovieApiException('Movie does not exist', ErrorCode::INTERNAL_ERROR);
        }

        $params['movie_id'] = $movieId;
        return $this->comment->create($params);
    }
}
