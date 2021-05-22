<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{

    const CREATED_AT = 'time_added';
    const UPDATED_AT = 'last_updated';

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