<?php

namespace App\Http\Controllers;

use App\Http\Resources\SubjectCollection;
use App\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $subjects = Subject::query()->latest('created_at')->get();

            return response()->json(new SubjectCollection($subjects));
        }

        return view('subject');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
            'code' => 'required|string|max:255',
        ]);

        Subject::create([
            'name' => $request->input('name'),
            'code' => $request->input('code')
        ]);

        return response()->json([
            'message' => 'Subject was created'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required|string|max:255',
        ]);

        $subject = Subject::query()->find($id);


        tap($subject)->update([
            'name' => $request->input('name'),
            'code' => $request->input('code')
        ])->save();

        return response()->json([
            'message' => 'Subject was updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy($id)
    {
        Subject::destroy($id);

        return response()->json([
            'message' => 'Subject was deleted'
        ]);
    }
}
