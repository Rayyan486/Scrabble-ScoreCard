<?php

namespace Database\Seeders;

use App\Models\Game;
use App\Models\Member;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Disable foreign key checks to allow truncation
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');

        // Truncate tables to start fresh
        Member::truncate();
        Game::truncate();
        DB::table('game_member')->truncate();

        // Re-enable foreign key checks
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Create 20 members
        echo "Creating 20 members...\n";
        $members = Member::factory()->count(20)->create();
        echo "Created " . $members->count() . " members.\n";

        // Create 50 games, each with 2-4 random members
        echo "Creating 50 games...\n";
        $games = Game::factory()->count(50)->create()->each(function ($game) {
            // Get 2-4 random members that aren't already attached to this game
            $existingMemberIds = $game->members()->pluck('members.id')->toArray();
            $members = Member::whereNotIn('id', $existingMemberIds)
                            ->inRandomOrder()
                            ->take(rand(2, 4))
                            ->get();
            if ($members->isNotEmpty()) {
                $game->members()->attach(
                    $members->mapWithKeys(function ($member) {
                        return [$member->id => ['score' => rand(100, 500)]];
                    })
                );
                echo "Attached members to game ID {$game->id}.\n";
            } else {
                echo "No members available to attach to game ID {$game->id}.\n";
            }
        });
        echo "Created " . $games->count() . " games.\n";
    }
}
