<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    public function index(Request $request)
    {
        $query = Subject::withCount('posts')
            ->with(['posts' => fn ($q) => $q->latest('updated_at')]);

        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->input('search') . '%');
        }

        $subjects = $query->get()->map(function ($subject) {
            $subject->last_activity = optional($subject->posts->first())->updated_at;
            return $subject;
        });

        return view('subjects.index', compact('subjects'));
    }

    public function show(Request $request, $id)
    {
        $subject = Subject::with('major')->findOrFail($id);

        $query = Post::with(['user', 'attachments'])
            ->where('subject_id', $subject->id);

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function ($q) use ($search) {
                $q->where('title', 'like', '%' . $search . '%')
                    ->orWhere('content', 'like', '%' . $search . '%');
            });
        }

        $posts = $query->latest()->get();

        return view('subjects.show', compact('subject', 'posts'));
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
