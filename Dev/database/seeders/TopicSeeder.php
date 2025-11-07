<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\Topic;
use App\Models\User;
use Illuminate\Database\Seeder;

class TopicSeeder extends Seeder
{
    public function run(): void
    {
        $threads = Thread::all();
        $users = User::where('is_admin', false)->get();

        foreach ($threads as $thread) {

            Topic::factory()->count(3)->create([
                'thread_id' => $thread->thread_id,
                'user_id' => $users->random()->user_id,
            ]);
        }
    }
}
