<?php

namespace Tests\Unit;

use App\Exceptions\DuplicateVoteException;
use App\Exceptions\VoteNotFoundException;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;


class IdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function can_check_if_an_idea_is_voted_for_by_user()
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
            'idea_id' =>$idea->id,
            'user_id' => $user->id,
        ]);

        $this->assertTrue($idea->isVotedByUser($user));

        $this->assertFalse($idea->isVotedByUser($userB));

        $this->assertFalse($idea->isVotedByUser(null));
    }


    /** @test */
    public function user_can_vote_for_idea()
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

        $idea->vote($user);

        $this->assertTrue($idea->isVotedByUser($user));
      
    }

    /** @test */
    public function user_can_unvote_for_idea()
    {
        $user = User::factory()->create();

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

        $this->assertTrue($idea->isVotedByUser($user));

        $idea->removeVote($user);

        $this->assertFalse($idea->isVotedByUser($user));
    }



    /** @test */
    public function voting_an_idea_that_is_already_there_will_throw_an_exception()
    {
        $user = User::factory()->create();

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

        $this->expectException(DuplicateVoteException::class);
        
        $idea->vote($user);
        
        $this->getExpectedException(DuplicateVoteException::class);

    }

    /** @test */
    public function removing_vote_an_idea_that_is_already_there_will_throw_an_exception()
    {
        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);

        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => 'bg-gray-200']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $this->expectException(VoteNotFoundException::class);

        $idea->removeVote($user);

        // dd($this->getExpectedException(VoteNotFoundException::class));
    }
}
