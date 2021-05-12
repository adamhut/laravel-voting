<?php

namespace Tests\Feature\Filters;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeasIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SearchFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function search_works_when_more_than_3_characters()
    {

        $user   = User::factory()->create();
        $userB  = User::factory()->create();
        $userC  = User::factory()->create();

        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);


        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'second')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 1 
                     && $ideas->first()->title == 'My second idea';
            });
    }

    /** @test */
    public function  does_not_perform_search_if_less_than_three_characters()
    {

        $user   = User::factory()->create();
        $userB  = User::factory()->create();
        $userC  = User::factory()->create();

        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);


        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'ab')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3;
            });
    }

    /** @test */
    public function search_works_correctlly_with_category_filters()
    {

        $user   = User::factory()->create();
        $userB  = User::factory()->create();
        $userC  = User::factory()->create();

        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $idea2 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My second idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);

        $idea3 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My third idea',
            'category_id' => $category2->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);


        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('search', 'second')
            ->set('category', 'category1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 1
                    && $ideas->first()->title == 'My second idea';
            });
        Livewire::test(IdeasIndex::class)
            ->set('category', 'category1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2;
            });
    }    


}
