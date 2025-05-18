@extends('layouts.root-layout')

@section('content')
    <h2 class="text-center mb-4">Смерови</h2>

    <div class="row justify-content-center">
        <div class="col-md-6">
            <ul class="list-group">
                @foreach($majors as $major)
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <a href="{{ route('majors.show', $major->id) }}" class="text-decoration-none">
                            {{ $major->name }}
                        </a>
                    </li>
                @endforeach
            </ul>
        </div>
    </div>
@endsection
