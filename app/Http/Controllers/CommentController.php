<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function index(Post $post): JsonResponse
    {
        $comments = $post->comments()
            ->with([
                'user',
                'attachments',
                'replies' => function($query) {
                    $query->with(['user', 'attachments']);
                }
            ])
            ->whereNull('parent_id')
            ->get();

        return response()->json($comments);
    }

    public function store(Request $request, $id)
    {
        $validated = $request->validate([
            'content' => 'required|string',
            'parent_id' => 'nullable|exists:comments,id'
        ]);

        $post = Post::findOrFail($id);

        $comment = $post->comments()->create([
            'content' => $validated['content'],
            'user_id' => Auth::id(),
            'parent_id' => $validated['parent_id'] ?? null
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
