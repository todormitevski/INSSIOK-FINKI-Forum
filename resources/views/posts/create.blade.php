@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <h1>Create a New Post for {{ $subject->name }}</h1>

        <form action="{{ route('subjects.posts.store', $subject->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-3">
                <label for="title" class="form-label">Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>
            <div class="mb-3">
                <label for="content" class="form-label">Content</label>
                <textarea class="form-control" id="content" name="content" rows="5" required></textarea>
            </div>
            <div class="mb-3">
                <label for="attachments" class="form-label">Attachments</label>
                <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
            </div>
            <button type="submit" class="btn btn-primary">Create Post</button>
        </form>
    </div>
@endsection
