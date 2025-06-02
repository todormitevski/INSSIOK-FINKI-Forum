@extends('layouts.root-layout')

@section('content')
    <div class="container">
        <h1 class="mb-3">{{ $major->name }}</h1>
        <p class="lead">Explore subjects for {{ $major->name }}. Click on a subject to view discussions.</p>

        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Subjects</h5>
            </div>
            <ul class="list-group list-group-flush">
                @forelse ($subjects as $subject)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="mb-1 fw-bold">
                                <a href="{{ route('subjects.show', $subject->id) }}" class="text-decoration-none text-primary">
                                    {{ $subject->name }}
                                </a>
                            </h6>
                            <small class="text-muted">Click to view discussions</small>
                        </div>
                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-primary btn-sm">
                            Прикажи Дискусии
                        </a>
                    </li>
                @empty
                    <li class="list-group-item text-center text-muted">
                        No subjects found for this major.
                    </li>
                @endforelse
            </ul>
        </div>
    </div>
@endsection
