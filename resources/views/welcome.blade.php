@extends('layouts.root-layout')

@section('header')
    <header class="bg-primary text-white text-center py-5">
        <div class="container">
            <h1>Добредојдовте на Студентскиот Форум</h1>
            <p class="lead">
                Официјалниот форум за студентите на ФИНКИ! Споделувајте искуства, дискутирајте за предмети и разменувајте корисни материјали.
            </p>
        </div>
    </header>
@endsection

@section('content')
    <h2 class="text-center mb-4">Смерови</h2>
    <div class="row">
        @foreach($majors as $major)
            <div class="col-md-4 mb-4">
                <div class="card major-card h-100">
                    <div class="card-body">
                        <h5 class="card-title">{{ $major->name }}</h5>
                        <p class="card-text">{{ Str::limit($major->description, 100) }}</p>
                        <a href="{{ route('majors.show', $major->id) }}" class="btn btn-primary">Прикажи Предмети</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
@endsection
