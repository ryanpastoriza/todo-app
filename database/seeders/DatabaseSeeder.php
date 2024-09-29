<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Task;
use App\Models\User;
use App\Models\Tag;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory(5)->create();

        $users = User::all();

        Tag::truncate();

        $tags = [
            'Event',
            'Work',
            'Review',
        ];

        foreach ($tags as $tag) {
            Tag::create(['name' => $tag]);
        }

        foreach($users as $user) {

            $limit = random_int(10, 20);

            for ($i = 0; $i < $limit; $i++) {

                $task = Task::factory()->for($user)->create();

                if( $task->completed ) {
                    $task->update(['completed_at' => fake()->dateTimeBetween('+1 month', '+5 months') ]);                    
                }

                $task->update(['order' => $i+1 ]);

                $task->tags()->sync(array_rand(Tag::where('id', '>', 0)->pluck('id')->toArray())+1, false);

            }
        }
    }
}
