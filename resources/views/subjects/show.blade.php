@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <h1>{{ $subject->name }}</h1>
        <p class="lead">{{ $subject->name }}</p>

        <a href="{{ route('posts.create', $subject->id) }}" class="btn btn-primary mb-4">Create New Post</a>

        </a>

        <div class="row">
            @foreach ($posts as $post)
                <div class="col-md-4 mb-4">
                    <div class="card subject-card shadow-sm">
                        <div class="card-body">
                            <h5 class="card-title">{{ $post->title }}</h5>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
