<?php

namespace App\Http\Controllers;

use App\Http\Resources\TeacherCollection;
use App\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
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
            $teachers = Teacher::query()->latest('created_at')->get();

            return response()->json(new TeacherCollection($teachers));
        }

        return view('teacher');

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
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'id_no'     => 'nullable|string|max:255',
        ]);

        Teacher::create([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'id_no'     => $request->input('id_no'),
        ]);

        return response()->json([
            'message' => 'Teacher was created'
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
     * @param  int $id
     * @return \Illuminate\Http\Response
     * @throws \Illuminate\Validation\ValidationException
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'      => 'required|string|max:255',
            'email'     => 'nullable|string|max:255',
            'telephone' => 'nullable|string|max:255',
            'id_no'     => 'nullable|string|max:255',
        ]);

        $teacher = Teacher::find($id);

        tap($teacher)->update([
            'name'      => $request->input('name'),
            'email'     => $request->input('email'),
            'telephone' => $request->input('telephone'),
            'id_no'     => $request->input('id_no'),
        ])->save();

        return response()->json([
            'message' => 'Teacher was updated'
        ]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Teacher::destroy($id);

        return response()->json([
            'message' => 'Teacher was deleted'
        ]);
    }
}
