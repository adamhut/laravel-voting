<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory()->create([
            'name'=>'adam',
            'email' =>'adamhut@gmail.com',
            'password' => bcrypt('secret'),
        ]);
        User::factory(19)->create();
        
        $this->call(CategorySeeder::class);
        $this->call(StatusSeeder::class);
        $this->call(IdeaSeeder::class);

        //generate unique votes, ensure idea_id and user_id are uqique foreach row
        $this->call(VoteSeeder::class);
    }
}
