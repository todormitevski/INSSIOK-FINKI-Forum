<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $major->name }} - FINKI Forum</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .subject-card {
            transition: transform 0.3s, box-shadow 0.3s;
            cursor: pointer;
        }
        .subject-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="#">FINKI Forum</a>
    </div>
</nav>

<div class="container my-5">
    <h1>{{ $major->name }}</h1>
    <p class="lead">Explore subjects for {{ $major->name }}. Click on a subject to view details.</p>

    <div class="row">
        @foreach ($subjects as $subject)
            <div class="col-md-4 mb-4">
                <div class="card subject-card shadow-sm">
                    <div class="card-body">
                        <h5 class="card-title">{{ $subject->name }}</h5>
                        <a href="{{ route('view.subject', $subject->id) }}" class="btn btn-primary">View Details</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
