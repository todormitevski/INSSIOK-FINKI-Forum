<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FINKI Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="icon" type="image/png" href="{{ asset('images/favicon.png') }}">
    <style>
        .major-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .major-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.2);
        }
        .post-entry {
            margin-top: 10px;
            border-top: 1px solid #dee2e6;
            transition: background-color 0.2s ease;
        }
        .post-entry:hover {
            background-color: #f8f9fa;
            cursor: pointer;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container">
        <a class="navbar-brand d-flex align-items-center" href="/">
            <img src="{{ asset('images/finki-logo.png') }}" alt="FINKI Forum Logo" height="40" class="me-2">
            FINKI Forum
        </a>
        <ul class="navbar-nav ms-auto">
            <li class="nav-item"><a class="nav-link" href="{{ route('majors.index') }}">Смерови</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('subjects.index') }}">Предмети</a></li>
        </ul>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item">
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-inline">
                            @csrf
                            <button type="submit" class="nav-link btn btn-link" style="border: none; background: none; padding: 0;">
                                Logout
                            </button>
                        </form>
                    </li>
                @else
                    <li class="nav-item"><a class="nav-link" href="{{ route('show.login') }}">Login</a></li>
                    <li class="nav-item"><a class="nav-link" href="{{ route('show.register') }}">Register</a></li>
                @endauth
            </ul>
        </div>
    </div>
</nav>

{{-- optional --}}
@yield('header')

<main class="container my-5">
{{--    the dynamic content will go here--}}
    @yield('content')
</main>

<footer class="bg-light text-center py-3">
    <p>&copy; {{ date('Y') }} FINKI Forum. All Rights Reserved.</p>
</footer>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
