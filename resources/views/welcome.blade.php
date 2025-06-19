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
    <div class="container my-5" id="root-container">
        <form action="{{ route('search') }}" method="GET" class="mb-5">
            <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Пребарај постови, предмети, корисници...">
                <button type="submit" class="btn btn-outline-primary">
                    <i class="bi bi-search"></i> Пребарај
                </button>
            </div>
        </form>
        <div class="row g-4">
            <div class="col-lg-3">
                <div class="card shadow-sm h-100">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-chat-left-text mr-2"></i> Активни дискусии</h5>
                    </div>
                    <div class="card-body p-0">
                        <div class="list-group list-group-flush">
                            @foreach($recentPosts as $post)
                                <a href="{{ route('posts.show', $post->id) }}" class="list-group-item list-group-item-action forum-post-link">
                                    <div class="d-flex w-100 justify-content-between">
                                        <h6 class="mb-1">{{ $post->title }}</h6>
                                        <small class="text-muted">{{ $post->created_at->diffForHumans() }}</small>
                                    </div>
                                    <p class="mb-1 text-muted small">{{ Str::limit($post->content, 60) }}</p>
                                    <small class="text-muted">Во: {{ $post->subject->name }}</small>
                                </a>
                            @endforeach
                        </div>
                    </div>
                    <div class="card-footer bg-white border-top-0">
                        <a href="{{ route('posts.index') }}" class="btn btn-outline-primary btn-sm w-100">
                            Види ги сите <i class="bi bi-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-book mr-2"></i> Смерови</h5>
                    </div>
                    <div class="card-body">
                        <div class="row g-3">
                            @foreach($majors as $major)
                                <div class="col-md-6">
                                    <div class="card major-card h-100">
                                        <div class="card-body">
                                            <div class="d-flex align-items-center mb-2">
                                                <div class="bg-primary rounded p-2 me-3">
                                                    <i class="bi bi-mortarboard text-white"></i>
                                                </div>
                                                <h5 class="card-title mb-0">{{ $major->name }}</h5>
                                            </div>
                                            <p class="card-text text-muted small">{{ Str::limit($major->description, 90) }}</p>
                                        </div>
                                        <div class="card-footer bg-white border-top-0 pt-0">
                                            <div class="d-flex justify-content-between align-items-center">
                                                <a href="{{ route('majors.show', $major->id) }}" class="btn btn-sm btn-outline-primary">
                                                    <i class="bi bi-eye me-1"></i>Предмети
                                                </a>
                                                <span class="badge bg-primary rounded-pill">{{ $major->subjects_count }}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-3">
                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-fire mr-2"></i> Популарни предмети</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($popularSubjects as $subject)
                                <a href="{{ route('subjects.show', $subject->id) }}" class="list-group-item list-group-item-action forum-post-link">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <span>{{ $subject->name }}</span>
                                        <span class="badge bg-primary rounded-pill">{{ $subject->posts_count }}</span>
                                    </div>
                                </a>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm mb-4">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-people mr-2"></i> Најактивни корисници</h5>
                    </div>
                    <div class="card-body p-0">
                        <ul class="list-group list-group-flush">
                            @foreach($activeUsers as $user)
                                <li class="list-group-item">
                                    <div class="d-flex align-items-center">
                                        <img src="https://ui-avatars.com/api/?name={{ urlencode($user->name) }}&background=random"
                                             alt="{{ $user->name }}" class="rounded-circle me-2" width="30">
                                        <div class="flex-grow-1">
                                            {{ $user->name }}
                                        </div>
                                        <span class="badge bg-primary rounded-pill">{{ $user->posts_count }}</span>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="card shadow-sm">
                    <div class="card-header bg-primary text-white">
                        <h5 class="mb-0"><i class="bi bi-bar-chart mr-2"></i> Статистики</h5>
                    </div>
                    <div class="card-body">
                        <ul class="list-unstyled mb-0">
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Објави:</span>
                                <strong>{{ $stats['total_posts'] }}</strong>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Корисници:</span>
                                <strong>{{ $stats['total_users'] }}</strong>
                            </li>
                            <li class="mb-2 d-flex justify-content-between">
                                <span>Предмети:</span>
                                <strong>{{ $stats['total_subjects'] }}</strong>
                            </li>
                            <li class="d-flex justify-content-between">
                                <span>Денес:</span>
                                <strong>{{ $stats['today_posts'] }}</strong>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
