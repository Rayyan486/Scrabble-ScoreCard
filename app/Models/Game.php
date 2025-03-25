<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    use HasFactory;

    protected $fillable = ['played_at'];

    protected $casts = [
        'played_at' => 'datetime',
    ];

    public function members()
    {
        return $this->belongsToMany(Member::class, 'game_member')
                    ->withPivot('score')
                    ->withTimestamps();
    }
}
