<?php

namespace App\Http\Controllers;

use App\Http\Resources\StudentCollection;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StudentController extends Controller
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
            $students = Student::query()->latest('created_at')->get();

            return response()->json(new StudentCollection($students));
        }

        return view('student');
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
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name'         => 'required|string|max:255',
            'email'        => 'nullable|email',
            'dob'          => 'required|date_format:Y-m-d',
            'classes_id'   => 'required|exists:classes,id',
            'admission_no' => 'required|unique:students'
        ]);

        DB::transaction(function () use ($request) {
            $student = new Student([
                'name'         => $request->input('name'),
                'email'        => $request->input('email'),
                'gender'       => $request->input('gender'),
                'dob'          => $request->input('dob'),
                'admission_no' => $request->input('admission_no'),
            ]);


            $student->save();

            $student->classes()->attach($request->input('classes_id'), [
                'year_id' => DB::table('years')->first()->id
            ]);

        });

        return response()->json([
            'message' => 'student was successfully created'
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
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(Request $request, Student $student)
    {
        tap($student)->update([
            'name'         => $request->input('name'),
            'email'        => $request->input('email'),
            'gender'       => $request->input('gender'),
            'dob'          => $request->input('dob'),
            'admission_no' => $request->input('admission_no'),
        ])->save();

//        $student->classes()->sync($request->input('classes_id'));

        return response()->json([
            'message' => 'student was successfully updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Student $student
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Student $student)
    {
        try {
            $student->delete();

            return response()->json([
                'message' => 'student was successfully deleted'
            ]);
        } catch (\Exception $exception) {

        }
    }
}
