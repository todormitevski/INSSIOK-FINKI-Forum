@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <h1>{{ $subject->name }}</h1>
        <p class="lead">{{ $subject->major->name }}</p>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @auth
            <a href="{{ route('subjects.posts.create', $subject->id) }}" class="btn btn-primary mb-4">Create New Post</a>
        @endauth

        <div class="mb-5">
            <h2 class="mb-4">Posts</h2>

            @forelse ($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="text-decoration-none text-dark">
                    <div class="post-entry py-3 px-2">
                        <div class="d-flex align-items-center mb-2">
                            <img src="{{ asset('images/user-icon.png') }}" alt="User Icon" class="me-2 rounded-circle" width="40" height="40">
                            <span class="fw-bold">{{ $post->user->name }}</span>
                        </div>
                        <h4>{{ $post->title }}</h4>
                        <p>{{ Str::limit($post->content, 150) }}</p>

                        @if ($post->attachments && $post->attachments->count())
                            <div class="mt-2">
                                <p class="mb-1 text-muted">Attachments:</p>
                                <ul class="list-unstyled">
                                    @foreach ($post->attachments as $attachment)
                                        <li>
                                            📎 {{ $attachment->file_name }}
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </a>
            @empty
                <p>No posts yet for this subject.</p>
            @endforelse
        </div>
    </div>
@endsection
