<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $table = 'comments';

    protected $fillable = ['message', 'movie_id', 'ip_address'];

    public function people()
    {
        return $this->belongsTo('App\Models\Movie');
    }
}
