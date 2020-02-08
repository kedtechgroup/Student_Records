<?php


namespace App\Http\Controllers;


use App\Exam;
use Illuminate\Http\Request;

class ExamController
{
    public function index(Request $request)
    {
        if ($request->wantsJson()) {
            $exams = Exam::query()->latest()->paginate();

            return response()->json($exams);
        }
    }
}
