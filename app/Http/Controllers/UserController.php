<?php

namespace App\Http\Controllers;
use Illuminate\Http\Response;

class UserController extends Controller
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
    
    public function displayInfo()
    {
    
    	$info = app('db')->select('SELECT * FROM tbl_site_info');
    	$data = ['info' => $info];
    
    	return (new Response(json_encode($data), 200))
                  ->header('Content-Type', 'application/json');
    }

    //
}
