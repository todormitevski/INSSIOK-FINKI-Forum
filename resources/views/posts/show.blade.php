@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <div class="mb-4">
            <h5 class="text-muted">{{ $subject->name }}</h5>
            <div class="bg-white rounded shadow-sm p-4">
                <h2 class="fw-bold">{{ $post->title }}</h2>
                <p class="lead mb-3">{{ $post->content }}</p>

                @if ($post->attachments && $post->attachments->count())
                    <div class="mt-3">
                        <p class="mb-1 text-muted fw-semibold">📎 Attachments:</p>
                        <ul class="list-unstyled">
                            @foreach ($post->attachments as $attachment)
                                <li>
                                    <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">{{ $attachment->file_name }}</a>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                @endif
            </div>
        </div>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <div class="mb-5">
            <h3 class="mb-4">💬 Comments</h3>

            @forelse ($comments as $comment)
                <div class="bg-light rounded p-3 mb-3 shadow-sm">
                    <div class="d-flex align-items-center mb-2">
                        <img src="{{ asset('images/user-icon.png') }}" alt="User Icon"
                             class="me-2 rounded-circle border" width="40" height="40">
                        <span class="fw-semibold">{{ $comment->user->name }}</span>
                    </div>
                    <p class="mb-2">{{ $comment->content }}</p>

                    @if ($comment->attachments && $comment->attachments->count())
                        <div class="mt-2">
                            <p class="mb-1 text-muted">📎 Attachments:</p>
                            <ul class="list-unstyled">
                                @foreach ($comment->attachments as $attachment)
                                    <li>
                                        <a href="{{ asset('storage/' . $attachment->file_path) }}" target="_blank">
                                            {{ $attachment->file_name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            @empty
                <p class="text-muted">No comments yet for this post.</p>
            @endforelse
        </div>

        @auth
            <div class="card shadow-sm mb-5">
                <div class="card-header bg-primary text-white fw-semibold">
                    Add a Comment
                </div>
                <div class="card-body bg-light">
                    <form action="{{ route('posts.comments.store', $post->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <div class="mb-3">
                            <label for="content" class="form-label">Your Comment</label>
                            <textarea name="content" id="content" class="form-control" rows="4" required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="attachments" class="form-label">Attachments</label>
                            <input type="file" class="form-control" id="attachments" name="attachments[]" multiple>
                        </div>

                        <p class="text-muted">Posting as <strong>{{ auth()->user()->name }}</strong></p>

                        <button type="submit" class="btn btn-primary">Submit Comment</button>
                    </form>
                </div>
            </div>
        @endauth
    </div>
@endsection
