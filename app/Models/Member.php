<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'joined_at'];

    protected $casts = [
        'joined_at' => 'datetime',
    ];

    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_member')
                    ->withPivot('score')
                    ->withTimestamps();
    }

    public function averageScore()
    {
        return $this->games()->avg('game_member.score') ?? 0;
    }

    public function highestScore()
    {
        return $this->games()->max('game_member.score') ?? 0;
    }

    public function highestScoreGame()
    {
        return $this->games()
                    ->where('game_member.score', $this->highestScore())
                    ->first();
    }
}
