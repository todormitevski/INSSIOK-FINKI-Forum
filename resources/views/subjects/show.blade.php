@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">

        <div class="mb-4 pb-2 border-bottom">
            <h1 class="display-5 fw-bold">{{ $subject->name }}</h1>
            <p class="lead text-muted">{{ $subject->major->name }}</p>

            @if (session('success'))
                <div class="alert alert-success mt-3">{{ session('success') }}</div>
            @endif

            @auth
                <a href="{{ route('subjects.posts.create', $subject->id) }}" class="btn btn-primary mt-3">
                    <i class="bi bi-pencil-square me-1"></i> Креирај Нов Пост
                </a>
            @endauth
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-header bg-light py-3">
                <h5 class="mb-0 text-uppercase text-muted">Дискусии</h5>
            </div>

            <div class="list-group list-group-flush">
                @forelse ($posts as $post)
                    <a href="{{ route('posts.show', $post->id) }}"
                       class="list-group-item list-group-item-action d-flex flex-column gap-1 py-4 forum-post-link">
                        <div class="d-flex justify-content-between align-items-center">
                            <div class="d-flex align-items-center">
                                <img src="{{ asset('images/user-icon.png') }}"
                                     class="rounded-circle me-3" width="40" height="40" alt="User Icon">
                                <strong class="me-2">{{ $post->user->name }}</strong>
                                <span class="text-muted small">• {{ $post->created_at->diffForHumans() }}</span>
                            </div>
                            @if ($post->attachments && $post->attachments->count())
                                <span class="badge bg-secondary text-white">
                                    <i class="bi bi-paperclip me-1"></i>{{ $post->attachments->count() }}
                                </span>
                            @endif
                        </div>

                        <h5 class="fw-semibold mb-1">{{ $post->title }}</h5>
                        <p class="text-muted mb-0">{{ Str::limit($post->content, 160) }}</p>
                    </a>
                @empty
                    <div class="p-4 text-center text-muted">
                        <i class="bi bi-info-circle me-1"></i> Нема активни постови за овој предмет.
                    </div>
                @endforelse
            </div>
        </div>
    </div>
@endsection
