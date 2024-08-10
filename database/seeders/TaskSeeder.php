<?php

namespace Database\Seeders;

use App\Models\Task;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class TaskSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach ($users as $user) {
            Task::create([
                'title' => 'Modify front-end components',
                'description' => 'You must refactor the components needed in the front',
                'due_date' => now()->addDays(),
                'category' => 'dev',
                'user_id' => $user->id,
                'status' => 'pending',
            ]);
        }


    }
}
