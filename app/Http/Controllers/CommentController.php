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

    public function store(Request $request, Post $post): JsonResponse
    {
        $request->validate([
            'content' => 'required|string',
            'attachment' => 'nullable|file|mimes:jpg,jpeg,png,pdf',
        ]);

        $comment = $post->comments()->create([
            'content' => $request->input('content'),
            'user_id' => auth()->id(),
        ]);

        // if an attachment is present
        if ($request->hasFile('attachment')) {
            $attachment = $request->file('attachment');
            $path = $attachment->store('attachments', 'public');
            $comment->attachments()->create([
                'file_path' => $path,
            ]);
        }

        return response()->json([
            'message' => 'Comment added successfully!',
            'data' => $comment->load('attachments') // eager loading the attachments
        ], 201);
    }
}
