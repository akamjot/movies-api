<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Director;


class DirectorController extends Controller {
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function getDirectors() {
         $directors = Director::all();
         return response()->json($directors);
     }
    
}
