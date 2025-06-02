<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index()
    {
        $subjects = Subject::withCount('posts')
            ->with(['posts' => fn ($q) => $q->latest('updated_at')])
            ->get()
            ->map(function ($subject) {
                $subject->last_activity = optional($subject->posts->first())->updated_at;
                return $subject;
            });
        return view('subjects/index', compact('subjects'));
    }

    public function show($id)
    {
        $subject = Subject::findOrFail($id);
        $posts = Post::with(['user', 'attachments'])
            ->where('subject_id', $subject->id)
            ->latest()
            ->get();
        return view('subjects/show', compact('subject', 'posts'));
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
