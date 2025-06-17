@extends('layouts.root-layout')

@section('content')
    <div class="container my-5">
        <h3>Comment Thread</h3>
        <x-comment :comment="$root" />
    </div>
@endsection
