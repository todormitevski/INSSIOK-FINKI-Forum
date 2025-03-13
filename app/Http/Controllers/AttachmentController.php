<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use App\Models\Comment;
use App\Models\Post;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\StreamedResponse;

class AttachmentController extends Controller
{
    public function index(): JsonResponse
    {
        $attachments = Attachment::all();
        return response()->json($attachments);
    }

    public function store(Request $request)
    {
        $request->validate([
            'file' => 'required|file|mimes:jpg,png,pdf,docx|max:2048',
            'post_id' => 'nullable|exists:posts,id',
            'comment_id' => 'nullable|exists:comments,id',
        ]);

        if ($request->post_id && $request->comment_id) {
            return response()->json(['error' => 'An attachment can only belong to a post or a comment, not both.'], 400);
        }

        if (!$request->post_id && !$request->comment_id) {
            return response()->json(['error' => 'An attachment must belong to either a post or a comment.'], 400);
        }

        $file = $request->file('file');
        $path = $file->store('private');

        $attachment = Attachment::create([
            'file_name' => $file->getClientOriginalName(),
            'file_path' => $path,
            'attachable_id' => $request->post_id ?? $request->comment_id,
            'attachable_type' => $request->post_id ? Post::class : Comment::class,
        ]);

        return response()->json($attachment, 201);
    }

    public function show($id)
    {
        $attachment = Attachment::findOrFail($id);
        return response()->json($attachment);
    }

    public function destroy($id): JsonResponse
    {
        $attachment = Attachment::findOrFail($id);

        // Delete the file from storage
        Storage::delete($attachment->file_path);

        // Delete the attachment record
        $attachment->delete();

        return response()->json(['message' => 'Attachment deleted successfully.']);
    }

    public function download($id): StreamedResponse
    {
        $attachment = Attachment::findOrFail($id);

        if (!Storage::exists($attachment->file_path)) {
            abort(404, 'File not found');
        }

        return Storage::download($attachment->file_path, $attachment->file_name);
    }
}
