<?php

namespace App\Http\Controllers\Catalog;

use App\Film;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;

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
        return response()->json(['status' => 200, 'data' => Film::all()]);
    }

    public function listFilms()
    {
    
    	$info = app('db')->select('SELECT * FROM tbl_films');
    	$data = ['films' => $info];
    
    	return (new Response(json_encode($data), 200))
                  ->header('Content-Type', 'application/json')
                  ->header('Access-Control-Allow-Origin', '*');
    }

    public function displayInfo($id)
    {
    
    	$info = app('db')->select("SELECT * FROM tbl_films WHERE film_id ='{$id}'");
    	$data = ['films' => $info];

        if (count($info) > 0)
        {
            return (new Response(json_encode($info[0]), 200))
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
        } else
        {
            return (new Response(json_encode(['status' => '404', 'error' => ['message' => "Resource not found."]]), 404))
            ->header('Content-Type', 'application/json')
            ->header('Access-Control-Allow-Origin', '*');
        }

    }

    //
}
