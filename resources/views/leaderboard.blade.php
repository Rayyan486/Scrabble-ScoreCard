<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Scrabble Leaderboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Scrabble Leaderboard</h1>

        <!-- Top 10 Members by Average Score -->
        <h3>Top 10 Members by Average Score</h3>
        <table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Average Score</th>
                </tr>
            </thead>
            <tbody>
                @foreach($topMembers as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ number_format($member->averageScore(), 2) }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- All Members with Details -->
        <h3>All Members</h3>
      <form method="GET" action="{{ route('leaderboard') }}" class="mb-3">
    <div class="input-group">
        <input type="text" name="search" class="form-control" placeholder="Search members by name" value="{{ $search ?? '' }}">
        <button type="submit" class="btn btn-primary">Search</button>
    </div>
</form>
  	<table class="table table-bordered mb-5">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Joined At</th>
                    <th>Average Score</th>
                    <th>Highest Score</th>
                    <th>Highest Score Game</th>
                </tr>
            </thead>
            <tbody>
                @foreach($members as $member)
                    <tr>
                        <td>{{ $member->name }}</td>
                        <td>{{ $member->joined_at->format('Y-m-d') }}</td>
                        <td>{{ number_format($member->averageScore(), 2) }}</td>
                        <td>{{ $member->highestScore() }}</td>
                        <td>
                            @if($member->highestScoreGame())
                                Game on {{ $member->highestScoreGame()->played_at->format('Y-m-d') }}
                            @else
                                N/A
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Recent Games -->
        <h3>Recent Games (Last 5)</h3>
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Played At</th>
                    <th>Players</th>
                </tr>
            </thead>
            <tbody>
                @foreach($recentGames as $game)
                    <tr>
                        <td>{{ $game->played_at->format('Y-m-d H:i:s') }}</td>
                        <td>
                            @foreach($game->members as $member)
                                {{ $member->name }} (Score: {{ $member->pivot->score }})<br>
                            @endforeach
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        <!-- Navigation Links -->
        <div class="text-center mt-4">
            <a href="{{ route('members.index') }}" class="btn btn-primary">Manage Members</a>
            <a href="{{ route('games.index') }}" class="btn btn-secondary">Manage Games</a>
        </div>
    </div>
</body>
</html>
