<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>FINKI Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f8f9fa;
        }
        .hero {
            background: url('https://www.radiomof.mk/wp-content/uploads/2014/12/finki-2.jpg') no-repeat center center/cover;
            background-size: cover;
            background-position: center;
            color: white;
            text-align: center;
            padding: 100px 20px;
        }
        .forum-card {
            transition: transform 0.3s;
        }
        .forum-card:hover {
            transform: scale(1.05);
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">FINKI Forum</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item"><a class="nav-link" href="{{ route('show.login') }}">Login</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('show.register') }}">Register</a></li>
                <li class="nav-item"><a class="nav-link" href="{{ route('logout') }}">Logout</a></li>
            </ul>
        </div>
    </div>
</nav>

<div class="hero">
    <h1>Welcome to the FINKI Forum</h1>
    <p class="lead">A place for students to discuss, share, and collaborate</p>
</div>

<div class="container my-5">
    <div class="row">
        @foreach ($majors as $major)
            <div class="col-md-6 mb-4">
                <div class="card forum-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $major->name }}</h5>
                        <p class="card-text text-muted">Engage in discussions, share knowledge, and connect with colleagues.</p>
                        <a href="#" class="btn btn-primary">Explore</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
