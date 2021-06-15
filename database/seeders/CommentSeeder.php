<?php

namespace Database\Seeders;

use App\Models\Idea;
use App\Models\Comment;
use Illuminate\Database\Seeder;
use Database\Factories\CommentFactory;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         foreach (Idea::all() as $idea) {
             Comment::factory(5)
                ->existing()
                ->create([
                    'idea_id' => $idea->id
                ]);
         }
    }
}
