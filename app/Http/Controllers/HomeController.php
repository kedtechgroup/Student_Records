<?php


namespace App\Http\Controllers;


use App\Years;

class HomeController
{
    public function index()
    {
        return view('index');
    }

    public function years()
    {
        return response()->json(Years::query()->latest()->paginate());
    }
}
