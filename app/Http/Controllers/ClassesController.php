<?php

namespace App\Http\Controllers;

use App\Classes;
use App\Http\Resources\ClassesCollection;
use Illuminate\Http\Request;

class ClassesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $students = Classes::query()->latest('created_at')->get();

            return response()->json(new ClassesCollection($students));
        }

        return view('class');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
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
            'name'       => 'required|string|max:255',
            'stream_id'  => 'required',
            'teacher_id' => 'required'
        ]);

        Classes::create([
            'name'       => $request->input('name'),
//            'ClassNameNumeric' => $request->input('ClassNameNumeric'),
            'teacher_id' => $request->input('teacher_id'),
            'stream_id'  => $request->input('stream_id'),
        ]);

        return response()->json([
            'message' => 'class was successfully created'
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
     * Show the form for editing the specified resource.
     *
     * @param Classes $classes
     * @return void
     */
    public function edit(Classes $classes)
    {

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  $classes
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $classes)
    {
        $classes = Classes::find($classes);

        $this->validate($request, [
            'name'       => 'required|string|max:255',
            'stream_id'  => 'required',
            'teacher_id' => 'required'
        ]);

        tap($classes)->update([
            'name'       => $request->input('name'),
            'teacher_id' => $request->input('teacher_id'),
            'stream_id'  => $request->input('stream_id'),
        ])->save();

        return response()->json([
            'message' => 'class was updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Classes::destroy($id);

        return response()->json([
            'message' => 'class was deleted'
        ]);
    }
}
