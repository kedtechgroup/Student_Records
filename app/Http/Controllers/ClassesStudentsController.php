<?php

namespace App\Http\Controllers;

use App\Classes;
use App\ClassStudent;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClassesStudentsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @param $classId
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index($classId, Request $request)
    {
        if ($request->expectsJson()) {

            $class = Classes::query()->find($classId);

            $year = DB::table('years')
                ->where('name', '=', now()->yearIso)
                ->first();


            $students = ClassStudent::query()
                ->with('student', 'classes')
                ->where('class_id', '=', $class->id)
                ->where('year_id', '=', $year->id)
                ->orderBy('created_at', 'desc')
                ->paginate();

            return response()->json($students);
        }

        return view('class');
    }

}
