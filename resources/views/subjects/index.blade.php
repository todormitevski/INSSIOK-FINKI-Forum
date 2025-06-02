@extends('layouts.root-layout')

@section('header')
    <header class="bg-primary text-white text-center py-5 shadow-sm">
        <div class="container text-center">
            <h1 class="display-5 fw-bold">Предмети</h1>
            <p class="lead text-light">Придружи се во дискусиите по предмети, постави прашања и сподели искуства.</p>
        </div>
    </header>
@endsection

@section('content')
    <div class="container my-5">
        <div class="table-responsive rounded shadow-sm">
            <table class="table table-hover align-middle mb-0 bg-white">
                <thead class="table-light text-uppercase small text-muted">
                <tr>
                    <th class="ps-4">Предмет</th>
                    <th class="text-center">Дискусии</th>
                    <th class="text-center">Последна Активност</th>
                    <th class="text-end pe-4">Дејство</th>
                </tr>
                </thead>
                <tbody>
                @forelse ($subjects as $subject)
                    <tr class="forum-row">
                        <td class="ps-4">
                            <div class="d-flex align-items-center">
                                <div class="bg-primary text-white rounded-circle d-flex align-items-center justify-content-center me-3" style="width: 40px; height: 40px;">
                                    <i class="bi bi-book fs-5"></i>
                                </div>
                                <div>
                                    <div class="fw-bold">{{ $subject->name }}</div>
                                    <small class="text-muted">Категорија на дискусии</small>
                                </div>
                            </div>
                        </td>
                        <td class="text-center">
                                <span class="badge bg-light text-dark px-3 py-2 rounded-pill shadow-sm">
                                    {{ $subject->posts_count ?? '—' }}
                                </span>
                        </td>
                        <td class="text-center text-muted">
                            {{ $subject->last_activity ? $subject->last_activity->diffForHumans() : 'Нема активност' }}
                        </td>
                        <td class="text-end pe-4">
                            <a href="{{ route('subjects.show', $subject->id) }}" class="btn btn-outline-primary btn-sm">
                                <i class="bi bi-chat-right-dots me-1"></i> Види дискусии
                            </a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4" class="text-center py-5 text-muted">
                            <i class="bi bi-exclamation-circle me-1"></i> Нема достапни предмети во моментот.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
