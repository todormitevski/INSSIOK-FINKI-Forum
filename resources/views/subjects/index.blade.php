@extends('layouts.root-layout')

@section('header')
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Предмети</h1>
            <p class="lead">Избери предмет и придружи се во дискусијата.</p>
        </div>
    </header>
@endsection

@section('content')
    <div class="row">
        @foreach ($subjects as $subject)
            <div class="col-md-6 col-lg-3 mb-4">
                <div class="card subject-card shadow-sm border-0">
                    <div class="card-header bg-primary" style="height: 10px;"></div>
                    <div class="card-body d-flex flex-column align-items-center">
                        <h5 class="card-title text-center fw-bold">{{ $subject->name }}</h5>
                        <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-primary mt-auto">
                            Прикажи Дискусии
                        </a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
