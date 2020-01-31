<?php

namespace App\Http\Controllers;

use App\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $students = Student::query()->latest('created_at')->get();
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
        $student = Student::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'gender'    => $request->input('gender'),
            'dob'       => $request->input('dob'),
            'status'    => $request->input('status'),
            'stream_id' => $request->input('stream_id'),
            'class_id'  => $request->input('class_id'),
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
     * @param Student $student
     * @return void
     */
    public function update(Request $request, Student $student)
    {
        tap($student)->update([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'gender'    => $request->input('gender'),
            'dob'       => $request->input('dob'),
            'status'    => $request->input('status'),
            'stream_id' => $request->input('stream_id'),
            'class_id'  => $request->input('class_id'),
        ])->save();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return void
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();
        } catch (\Exception $exception) {

        }
    }
}
