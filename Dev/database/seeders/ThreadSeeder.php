<?php

namespace Database\Seeders;

use App\Models\Thread;
use App\Models\User;
use Illuminate\Database\Seeder;

class ThreadSeeder extends Seeder
{
    public function run(): void
    {

        $admin = User::where('is_admin', true)->first();


        Thread::factory()->count(15)->create([
            'user_id' => $admin->user_id,
        ]);
    }
}
