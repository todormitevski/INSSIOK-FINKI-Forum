<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    public function index()
    {
        return response()->json(Post::all());
    }

    public function create($id)
    {
        $subject = Subject::findOrFail($id);
        return view('posts.create', compact('subject'));
    }

    public function storeForSubject(Request $request, $id)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:jpg,png,pdf,docx|max:2048',
        ]);

        $subject = Subject::findOrFail($id);

        $post = $subject->posts()->create([
            'title' => $validated['title'],
            'content' => $validated['content'],
            'user_id' => Auth::id(),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $post->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_content' => base64_encode(file_get_contents($file->getRealPath())),
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()->route('subjects.show', $subject->id)->with('success', 'Post created successfully!');
    }

    public function show(Post $post)
    {
        $comments = $post->comments()
            ->whereNull('parent_id')
            ->with(['user', 'attachments', 'repliesRecursive'])
            ->get();
        $subject = $post->subject;
        return view('posts/show', compact('post', 'subject', 'comments'));
    }

    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update($validated);
        return response()->json($post, 200);
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return response()->json(null, 204);
    }
}
