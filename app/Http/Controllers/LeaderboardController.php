<?php

namespace App\Http\Controllers;

use App\Models\Member;
use App\Models\Game;
use Illuminate\Http\Request;

class LeaderboardController extends Controller
{
    public function index()
    {
        // Get top 10 members by average score
        $topMembers = Member::with('games')
            ->get()
            ->sortByDesc(function ($member) {
                return $member->averageScore();
            })
            ->take(10);

        // Get all members with their stats
        $members = Member::with('games')->get();

        // Get recent games (last 5)
        $recentGames = Game::with('members')
            ->orderBy('played_at', 'desc')
            ->take(5)
            ->get();

        return view('leaderboard', compact('topMembers', 'members', 'recentGames'));
    }
}
