<?php


namespace App\Http\Controllers;


use App\ClassStudent;
use App\Result;
use Illuminate\Http\Request;

class ResultsController extends Controller
{
    public function store(Request $request)
    {
        $this->validate($request, [
            'marks'      => 'required|numeric|min:0|max:100',
            'subject_id' => 'required|numeric|min:1,exists:subjects,id',
            'exam_id'    => 'required|numeric|min:1,exists:exams,id',
            'term_id'    => 'required|numeric|min:1,exists:terms,id',
        ]);

        $classStudent = ClassStudent::query()->find($request->input('class_student_id'));

        Result::create([
            'subject_id'       => $request->input('subject_id'),
            'exam_id'          => $request->input('exam_id'),
            'class_student_id' => $request->input('class_student_id'),
            'term_id'          => $request->input('term_id'),
            'year_id'          => $classStudent->year_id,
            'marks'            => $request->input('marks'),
        ]);

        return response()->json([
            'message' => 'result was created'
        ]);

    }

    public function show($id)
    {

    }

    public function update(Request $request)
    {

    }

    public function destroy($id)
    {

    }
}
