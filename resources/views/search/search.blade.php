@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <h2 class="mb-4">Резултати за: <span class="text-primary">"{{ $q }}"</span></h2>

        <div class="mb-5">
            <h4 class="mb-3 text-muted"><i class="bi bi-book me-1"></i> Предмети</h4>
            @forelse ($subjects as $subject)
                <a href="{{ route('subjects.show', $subject->id) }}" class="list-group-item list-group-item-action mb-2 shadow-sm p-3">
                    <strong>{{ $subject->name }}</strong
                </a>
            @empty
                <p class="text-muted">Нема совпаѓања за предмети.</p>
            @endforelse
        </div>

        <div class="mb-5">
            <h4 class="mb-3 text-muted"><i class="bi bi-chat-left-text me-1"></i> Објави</h4>
            @forelse ($posts as $post)
                <a href="{{ route('posts.show', $post->id) }}" class="list-group-item list-group-item-action mb-3 shadow-sm p-3">
                    <div class="fw-bold">{{ $post->title }}</div>
                    <p class="text-muted mb-1">{{ Str::limit($post->content, 100) }}</p>
                    <small class="text-muted">Во: {{ $post->subject->name ?? 'Непознат предмет' }} • од {{ $post->user->name ?? 'Анонимно' }}</small>
                </a>
            @empty
                <p class="text-muted">Нема совпаѓања за објави.</p>
            @endforelse
        </div>
    </div>
@endsection
