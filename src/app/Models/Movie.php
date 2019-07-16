<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    protected $table = 'movies';

    protected $fillable = ['episode_id', 'title', 'opening_crawl', 'director', 'producer',
        'release_date', 'created', 'edited', 'url'];

    public function people()
    {
        return $this->belongsToMany('App\Models\Person');
    }

    public function comments()
    {
        return $this->hasMany('App\Models\Comment')
                    ->orderBy('created_at', 'asc');
    }

    public function getAll()
    {
        return $this->with(['people', 'comments'])
                    ->withCount('comments')
                    ->orderBy('release_date', 'asc')
                    ->get();
    }
}
