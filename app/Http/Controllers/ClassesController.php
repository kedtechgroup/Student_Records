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
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->expectsJson()) {
            $students = Classes::query()->latest('created_at')->get();

            return response()->json(new ClassesCollection($students));
        }
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
     */
    public function store(Request $request)
    {
        $class = Classes::create([
            'name'             => $request->input('name'),
            'ClassNameNumeric' => $request->input('ClassNameNumeric'),
            'teacher_id'       => $request->input('teacher_id'),
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Classes $classes
     * @return void
     */
    public function update(Request $request, Classes $classes)
    {
        tap($classes)->update([
            'name'             => $request->input('name'),
            'ClassNameNumeric' => $request->input('ClassNameNumeric'),
            'teacher_id'       => $request->input('teacher_id'),
        ])->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Classes $classes)
    {
        try {
            $classes->delete();
        } catch (\Exception $exception) {

        }
    }
}
