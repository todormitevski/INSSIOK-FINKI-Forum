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

        $attachment = Attachment::create([
            'file_name' => $file->getClientOriginalName(),
            'file_content' => base64_encode(file_get_contents($file->getRealPath())),
            'mime_type' => $file->getClientMimeType(),
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

        $attachment->delete();

        return response()->json(['message' => 'Attachment deleted successfully.']);
    }

    public function download($id): StreamedResponse
    {
        $attachment = Attachment::findOrFail($id);

        if (empty($attachment->file_content)) {
            abort(404, 'File content not found');
        }

        return response()->streamDownload(
            function () use ($attachment) {
                echo base64_decode($attachment->file_content);
            },
            $attachment->file_name,
            [
                'Content-Type' => $attachment->mime_type,
                'Content-Disposition' => 'attachment; filename="'.$attachment->file_name.'"',
                'Pragma' => 'no-cache',
                'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
                'Expires' => '0'
            ]
        );
    }
}
