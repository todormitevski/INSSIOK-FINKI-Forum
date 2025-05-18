<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function index(Post $post): JsonResponse
    {
        $comments = $post->comments()->with('attachments')->get();
        return response()->json($comments);
    }

    public function store(Request $request, Post $post)
    {
        $request->validate([
            'content' => 'required|string',
            'attachments.*' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        if ($request->hasFile('attachments')) {
            foreach ($request->file('attachments') as $file) {
                $path = $file->store('attachments', 'public');
                $comment->attachments()->create([
                    'file_path' => $path,
                    'file_name' => $file->getClientOriginalName(),
                ]);
            }
        }

        return redirect()
            ->route('posts.show', [$post->id])
            ->with('success', 'Comment added successfully!');
    }
}
