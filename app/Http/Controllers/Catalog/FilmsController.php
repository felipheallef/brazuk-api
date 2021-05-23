<?php

namespace App\Http\Controllers\Catalog;

use App\Models\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

use App\Exceptions\ApiException;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Flugg\Responder\Responder;

class FilmsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }
    
    public function getAllFilms()
    {
        return responder()->success(Film::all())->respond();
    }

    public function displayInfo($id)
    {

        try {
            $film = Film::where('film_id', $id)->firstOrFail();
            return responder()->success($film)->respond();
        } catch(ModelNotFoundException $e) {
            throw new ApiException("Film with id $id not found.");
        }

    }

    public function fetchBySlug($slug)
    {
    
    	try {
            $film = Film::where('slug', $slug)->firstOrFail();
            return responder()->success($film)->respond();
        } catch(ModelNotFoundException $e) {
            throw new ApiException("Film with slug $slug not found.");
        }

    }

    //
}
