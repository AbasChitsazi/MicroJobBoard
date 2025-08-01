<?php

namespace Database\Seeders;

use App\Models\Job;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        \App\Models\User::factory()->create([
            'name' => 'Abbas',
            'email' => 'Chitsazi3@gmail.com',
            'is_verified' => 1,
            'role' => 'admin'
        ]);

        \App\Models\User::factory(300)->create();

        $verifiedUsers = \App\Models\User::where('is_verified', 1)->get()->shuffle();

        for ($i = 0; $i < 20; $i++) {
            if ($verifiedUsers->isEmpty()) break;

            \App\Models\Employer::factory()->create([
                'user_id' => $verifiedUsers->pop()->id
            ]);
        }

        $employers = \App\Models\Employer::all();

        for ($i = 0; $i < 100; $i++) {
            \App\Models\Job::factory()->create([
                'employer_id' => $employers->random()->id
            ]);
        }

        foreach (\App\Models\User::where('is_verified', 1)->get() as $user) {
            $jobs = \App\Models\Job::inRandomOrder()->take(rand(0, 4))->get();
            foreach ($jobs as $job) {
                \App\Models\JobApplication::factory()->create([
                    'job_id'  => $job->id,
                    'user_id' => $user->id,
                ]);
            }
        }
    }
}
