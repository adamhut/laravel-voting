<?php

namespace Tests\Feature;

use App\Http\Livewire\IdeaIndex;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class VoteIndexPageTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_page_contain_idea_show_livewire_component()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSeeLivewire('idea-index');
    }


    /** @test */
    public function index_page_correctly_receives_votes_count()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $user->id,
        ]);

        Vote::factory()->create([
            'idea_id' => $idea1->id,
            'user_id' => $userB->id,
        ]);


        $this->get(route('idea.index'))
            ->assertViewHas('ideas', function($ideas){
                return $ideas->first()->votes_count == 2;
            });
    }


    /** @test */
    public function votes_count_show_correctly_on_index_page_livewire_component()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

  
            

        Livewire::test(IdeaIndex::class, [
            'idea' => $idea,
            'votesCount' => 5,
        ])
            ->assertSet('votesCount', 5);
            // ->assertSeeHtml('<div class="text-sm font-bold leading-none">5</div>')
            // ->assertSeeHtml('<div class="font-semibold text-2xl">5</div>');
    }

    /** @test */
    public function  user_who_is_logged_in_index_votes_if_idea_already_voted_for()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);


        Vote::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);


        $response = $this->actingAs($user)->get(route('idea.index'));
    
        $ideaWithVotes = $response['ideas']->items()[0];

        // dd($ideaWithVotes);

        Livewire::test(IdeaIndex::class, [
            'idea' => $ideaWithVotes,
            'votesCount' => 5,
        ])
            ->assertSet('votesCount', 5)
            ->assertSee('Voted');
    }

    /** @test */
    public function  user_who_is_not_logged_in_is_redirectd_to_login_page_when_trying_to_vote()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);


       

        $response = $this->get(route('idea.index'));

        $ideaWithVotes = $response['ideas']->items()[0];

        // dd($ideaWithVotes);

        Livewire::test(IdeaIndex::class, [
            'idea' => $ideaWithVotes,
            'votesCount' => 5,
        ])
            ->call('vote')
            ->assertRedirect(route('login'));
    }


    /** @test */
    public function user_who_is_logged_in_can_vote_for_idea()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);


        $this->assertDatabaseMissing('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Livewire::actingAs($user)
            ->test(IdeaIndex::class, [
                'idea' => $idea,
                'votesCount' => 5,
            ])
            ->call('vote')
            ->assertSet('votesCount', 6)
            ->assertSet('hasVoted', true)
            ->assertSee('Voted');

        $this->assertDatabaseHas('votes', [
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);
    }
}
