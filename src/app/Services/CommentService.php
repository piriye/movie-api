<?php

namespace App\Services;

use App\Models\Comment;

class CommentService
{
    private $comment;

    public function __construct(Comment $comment)
    {
        $this->comment = $comment;
    }

    public function createComment(int $movieId, array $params)
    {
        $params['movie_id'] = $movieId;
        return $this->comment->create($params);
    }
}
