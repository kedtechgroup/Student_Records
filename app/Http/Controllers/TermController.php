<?php


namespace App\Http\Controllers;


use App\Term;
use Illuminate\Http\Request;

class TermController extends Controller
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

    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|String|max:255'
        ]);

        Term::create([
            'name' => $request->input('name')
        ]);

        return response()->json([
            'message' => 'Term was created'
        ]);
    }

    public function update(Request $request, $id)
    {
        $term = Term::query()->find($id);

        tap($term)->update([
            'name' => $request->input('name')
        ])->save();

        return response()->json([
            'message' => 'Term was updated'
        ]);
    }

    public function destroy($id)
    {
        Term::destroy($id);

        return response()->json([
            'message' => 'Term was deleted'
        ]);
    }
}
