namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    public function games()
    {
        return $this->belongsToMany(Game::class, 'game_member')
                    ->withPivot('score')
                    ->withTimestamps();
    }

    public function averageScore()
    {
        return $this->games()->avg('game_member.score');
    }

    public function highestScore()
    {
        return $this->games()->max('game_member.score');
    }

    public function highestScoreGame()
    {
        return $this->games()->wherePivot('score', $this->highestScore())->first();
    }
}
