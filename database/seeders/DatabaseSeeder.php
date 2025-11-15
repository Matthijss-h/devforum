<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Thread;
use App\Models\Topic;
use App\Models\Reply;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    use WithoutModelEvents;

    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Administrator',
            'email' => 'admin@admin.com',
            'password' => ('password'),
        ]);

        User::factory(9)->create();
        Thread::factory(20)->create();
        Topic::factory(50)->create();
        Reply::factory(100)->create();
    }
}
