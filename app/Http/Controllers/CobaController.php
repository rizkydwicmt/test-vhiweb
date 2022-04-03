<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CobaController extends Controller
{
    public function asd(Request $request){
        return $request->all();
    }
}
