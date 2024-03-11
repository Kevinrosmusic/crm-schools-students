<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSchoolRequest;
use App\Http\Requests\UpdateSchoolRequest;
use App\Models\School;
use Illuminate\Http\Request;

class SchoolController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return School::get();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreSchoolRequest $request)
    {
        $school = School::create([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'web' => $request->web,
        ]);

        if ($request->logo) {
            $request->file('logo')->storeAs('logos', $school->id . '.jpg');
            $school->update(['logo' => $school->id . '.jpg']);
        }


        return response()->json([
            'message' => 'School created!',
            'data' => $school
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(School $school)
    {
        return $school;
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateSchoolRequest $request, School $school)
    {
        $school->update([
            'name' => $request->name,
            'address' => $request->address,
            'email' => $request->email,
            'phone' => $request->phone,
            'web' => $request->web,
        ]);

        if ($request->logo) {
            $request->file('logo')->storeAs('logos', $school->id . '.jpg');
            $school->update(['logo' => $school->id . '.jpg']);            
        }

        return response()->json([
            'message' => 'School updated!',
            'data' => $school
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(School $school)
    {
        $school->students()->delete();
        $school->delete();

        return response()->json([
            'message' => 'School eliminated!',
        ]);
    }
}
