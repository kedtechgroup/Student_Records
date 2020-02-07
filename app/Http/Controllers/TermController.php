<?php


namespace App\Http\Controllers;


use App\Term;
use Illuminate\Http\Request;

class TermController
{
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $terms = Term::query()
                ->latest('created_at')
                ->paginate();

            return response()->json($terms);
        }

        return view('term');
    }

    public function show($id)
    {

    }

    public function destroy()
    {

    }
}
