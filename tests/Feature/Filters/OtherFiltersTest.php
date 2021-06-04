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

class OtherFiltersTest extends TestCase
{
    use RefreshDatabase;

    

    /** @test */
    public function top_voted_filter_works()
    {

        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();

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


        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id,
        ]);
        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $userB->id,
        ]);

        Vote::factory()->create([
            'idea_id' => $idea2->id,
            'user_id' => $userC->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('filter', 'Top Voted')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->votes()->count() == 2
                    && $ideas->last()->votes()->count() == 1;
            });
    }


    /** @test */
    public function my_ideas_filter_works_correctlly_when_user_logged_in()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();


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
            'user_id' => $userB->id,
            'title' => 'My third idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);


        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->title == "My second idea"
                    && $ideas->last()->title == "My first idea";
            });
    }

    /** @test */
    public function my_ideas_filter_works_correctlly_when_user_is_not_logged_in()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();


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
            'user_id' => $userB->id,
            'title' => 'My third idea',
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('filter', 'My Ideas')

            ->assertRedirect(route('login'));
            
    }

    /** @test */
    public function my_ideas_filter_works_correctlly_with_category_filter()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();
        $userC = User::factory()->create();


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

        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'My Ideas')
            ->set('category', 'category1')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->title == "My second idea"
                    && $ideas->last()->title == "My first idea";
                  
            });
    }

    /** @test */
    public function no_filters_works_correctlly()
    {
        $user = User::factory()->create();

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
            'category_id' => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my second idea',
        ]);


        Livewire::test(IdeasIndex::class)
            ->set('filter', 'No Filter')
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3
                    && $ideas->first()->title == "My third idea"
                    && $ideas->last()->title == "My first idea";
            });
    }

    /** @test */
    public function spam_ideas_filters_works()
    {
        $user = User::factory()->admin()->create();

        $ideaOne = Idea::factory()->create([
            'user_id' => $user->id,
            'spam_reports' => 1,
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id' => $user->id,
            'spam_reports' => 2,
        ]);

        $ideaThree = Idea::factory()->create([
            'user_id' => $user->id,
            'spam_reports' => 3,
        ]);

        $ideaFour= Idea::factory()->create();


        Livewire::actingAs($user)
            ->test(IdeasIndex::class)
            ->set('filter', 'Spam Ideas')
            ->assertViewHas('ideas', function ($ideas) use($ideaOne,$ideaThree) {
                return $ideas->count() === 3
                && $ideas->first()->title == $ideaThree->title
                && $ideas->last()->title == $ideaOne->title;
            }); 
    }

}
