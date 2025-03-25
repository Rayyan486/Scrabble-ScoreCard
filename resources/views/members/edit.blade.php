<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Member Details</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Member Details</h1>
        <div class="card">
            <div class="card-body">
                <h5 class="card-title">{{ $member->name }}</h5>
                <p class="card-text"><strong>Joined At:</strong> {{ $member->joined_at->format('Y-m-d') }}</p>
                <p class="card-text"><strong>Average Score:</strong> {{ number_format($member->averageScore(), 2) }}</p>
                <p class="card-text"><strong>Highest Score:</strong> {{ $member->highestScore() }}</p>
            </div>
        </div>
        <div class="mt-3">
            <a href="{{ route('members.index') }}" class="btn btn-secondary">Back to Members</a>
        </div>
    </div>
</body>
</html>
