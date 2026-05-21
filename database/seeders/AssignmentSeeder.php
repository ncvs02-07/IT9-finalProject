<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use App\Models\Assignment;

class AssignmentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $user = \App\Models\User::first();
        if ($user && Assignment::count() === 0) {
            Assignment::create([
                'user_id' => $user->id,
                'subject' => 'Mathematics',
                'name' => 'Calculus Problem Set #4',
                'due_date' => '2026-04-28',
                'priority' => 'High',
                'status' => 'Pending',
                'notes' => 'Integration by parts',
            ]);
            Assignment::create([
                'user_id' => $user->id,
                'subject' => 'English Literature',
                'name' => 'Essay on Macbeth',
                'due_date' => '2026-04-25',
                'priority' => 'Medium',
                'status' => 'Pending',
                'notes' => '1500 words',
            ]);
            Assignment::create([
                'user_id' => $user->id,
                'subject' => 'Biology',
                'name' => 'Cell Division Lab Report',
                'due_date' => '2026-04-22',
                'priority' => 'High',
                'status' => 'Completed',
                'notes' => '',
            ]);
            Assignment::create([
                'user_id' => $user->id,
                'subject' => 'History',
                'name' => 'Research on Philippine Revolution',
                'due_date' => '2026-04-20',
                'priority' => 'Low',
                'status' => 'Pending',
                'notes' => 'Include primary sources',
            ]);
        }
    }
}
