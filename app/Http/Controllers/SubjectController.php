<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        return response()->json(Subject::all());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'major_id' => 'required|integer|exists:majors,id'
        ]);

        $subject = Subject::create($validated);
        return response()->json($subject, 201);
    }

    public function show(Subject $subject)
    {
        return response()->json($subject);
    }

    public function update(Request $request, Subject $subject)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'major_id' => 'required|integer|exists:majors,id'
        ]);

        $subject->update($validated);
        return response()->json($subject, 200);
    }

    public function destroy(Subject $subject)
    {
        $subject->delete();
        return response()->json(null, 204);
    }
}
