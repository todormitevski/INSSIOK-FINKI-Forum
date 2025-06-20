<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

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
                $comment->attachments()->create([
                    'file_name' => $file->getClientOriginalName(),
                    'file_content' => base64_encode(file_get_contents($file->getRealPath())),
                    'mime_type' => $file->getClientMimeType(),
                ]);
            }
        }

        return redirect()
            ->route('posts.show', [$post->id])
            ->with('success', 'Comment added successfully!');
    }

    public function thread(Comment $comment)
    {
        $root = $comment;

        while ($root->parent) {
            $root = $root->parent;
        }

        $root->load(['user', 'attachments', 'repliesRecursive']);

        return view('comments.thread', compact('root'));
    }
}
