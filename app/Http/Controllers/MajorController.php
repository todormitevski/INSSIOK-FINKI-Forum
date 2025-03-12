<?php

namespace App\Http\Controllers;

use App\Models\Major;
use App\Models\Subject;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    public function index()
    {
        $majors = Major::all();
        return view('majors/majors', compact('majors'));
    }

    public function view($id)
    {
        $major = Major::findOrFail($id);
        $subjects = $major->subjects;
        return view('majors/view', compact('major', 'subjects'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:majors,name|max:255',
        ]);

        $major = Major::create($validated);

        return response()->json($major, 201);
    }


    public function show(Major $major)
    {
        return response()->json($major);
    }


    public function update(Request $request, Major $major)
    {
        $validated = $request->validate([
            'name' => 'required|string|unique:majors,name,' . $major->id . '|max:255',
        ]);

        $major->update($validated);

        return response()->json($major);
    }


    public function destroy(Major $major)
    {
        $major->delete();
        return response()->json(['message' => 'Major deleted successfully']);
    }
}
