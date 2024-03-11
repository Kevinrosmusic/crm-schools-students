<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreStudentRequest;
use App\Http\Requests\UpdateStudentRequest;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Student::with('school')->get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreStudentRequest $request)
    {
        $student = Student::create([
            'school_id' => $request->school_id,
            'name' => $request->name,
            'surnames' => $request->surnames,
            'city' => $request->city,
            'birth_date' => $request->birth_date,
        ]);

        return response()->json([
            'message' => 'Student created!',
            'data' => $student
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Student $student)
    {
        $student = Student::with('school')->find($student->id);
        return $student;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateStudentRequest $request, Student $student)
    {
        $student->update([
            'school_id' => $request->school_id,
            'name' => $request->name,
            'surnames' => $request->surnames,
            'city' => $request->city,
            'birth_date' => $request->birth_date,
        ]);

        return response()->json([
            'message' => 'Student updated!',
            'data' => $student
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Student $student)
    {
        $student->delete();

        return response()->json([
            'message' => 'Student eliminated!',
        ]);
    }
}
