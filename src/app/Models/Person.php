<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'people';

    protected $fillable = ['name', 'height', 'mass', 'hair_color', 'skin_color', 'eye_color',
        'birth_year', 'gender', 'homeworld', 'release_date', 'created', 'edited', 'url'];

    protected $hidden = [ 'pivot' ];

    public function movies()
    {
        return $this->belongsToMany('App\Models\Movie');
    }
}
