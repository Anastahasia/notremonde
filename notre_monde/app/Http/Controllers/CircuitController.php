<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CircuitController extends Controller
{
    public function circuit(){
        return view('circuits.index');
    }

    public function create(){
        return view('gestion.create');
    }

    public function store(Request $request){
        dd($request);
    }
}
