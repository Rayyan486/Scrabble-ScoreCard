<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Member;

class MemberFactory extends Factory
{
    protected $model = Member::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->unique()->name(),
            'joined_at' => $this->faker->dateTimeBetween('-1 year', 'now'),
        ];
    }
}
