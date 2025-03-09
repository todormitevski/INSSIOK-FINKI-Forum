<?php

namespace App\Http\Controllers;

use App\Models\Attachment;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

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
            'file_name' => 'required|string',
            'file_path' => 'required|string',
            'post_id' => 'nullable|exists:posts,id',
            'comment_id' => 'nullable|exists:comments,id',
        ]);

        $attachment = Attachment::create([
            'file_name' => $request->file_name,
            'file_path' => $request->file_path,
            'post_id' => $request->post_id,
            'comment_id' => $request->comment_id,
        ]);

        return response()->json($attachment, 201);
    }

    public function show($id)
    {
        $attachment = Attachment::findOrFail($id);
        return response()->json($attachment);
    }

    public function destroy($id)
    {
        $attachment = Attachment::findOrFail($id);
        $attachment->delete();
        return response()->json(['message' => 'Attachment deleted successfully.']);
    }
}
