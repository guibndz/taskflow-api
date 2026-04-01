<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
use App\Models\Project;
use App\Models\Task;
use App\Models\Tag;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $tags = Tag::factory(10)->create();

        $users = User::factory(5)->create();

        foreach ($users as $user) {
            
            Profile::factory()->create([
                'user_id' => $user->id
            ]);

            $projects = Project::factory(rand(2, 4))->create([
                'user_id' => $user->id
            ]);

            foreach ($projects as $project) {
                
                $tasks = Task::factory(rand(3, 5))->create([
                    'project_id' => $project->id
                ]);

                foreach ($tasks as $task) {
                    $randomTags = $tags->random(rand(1, 3))->pluck('id')->toArray();
                    
                    $task->tags()->attach($randomTags);
                }
            }
        }
    }
}