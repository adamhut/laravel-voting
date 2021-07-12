<?php

namespace Tests\Unit;

use Tests\TestCase;
// use PHPUnit\Framework\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;



class StatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_get_count_of_each_status()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => 'bg-gray-200']);
        $statusInProgress = Status::factory()->create(['name' => 'In Progress', 'classes' => 'bg-gray-200']);
        $statusImplemented = Status::factory()->create(['name' => 'Implemented', 'classes' => 'bg-gray-200']);
        $statusClosed = Status::factory()->create(['name' => 'Closed', 'classes' => 'bg-gray-200']);

         Idea::factory()->create([
            'user_id' => $user->id,
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        Idea::factory(2)->create([
            'user_id' => $user->id,
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusConsidering->id,
            'description' => 'Description of my first idea',
        ]);

        Idea::factory(3)->create([
            'user_id' => $user->id,
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusInProgress->id,
            'description' => 'Description of my first idea',
        ]);


        Idea::factory(4)->create([
            'user_id' => $user->id,
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusImplemented->id,
            'description' => 'Description of my first idea',
        ]);

        Idea::factory(5)->create([
            'user_id' => $user->id,
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusClosed->id,
            'description' => 'Description of my first idea',
        ]);


        // dd(Status::getCount());
        $this->assertEquals(15,Status::getCount()['all_statuses']);
        $this->assertEquals(1, Status::getCount()['open']);
        $this->assertEquals(2, Status::getCount()['considering']);
        $this->assertEquals(3, Status::getCount()['in_progress']);
        $this->assertEquals(4, Status::getCount()['implemented']);
        $this->assertEquals(5, Status::getCount()['closed']);


    }



}
