<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'film_id', 'title', 'description', 'release_year', 'language_id',
        'length', 'rating', 'last_updated', 'time_added'
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [];
}