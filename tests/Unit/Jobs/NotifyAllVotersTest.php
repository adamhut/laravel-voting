<?php

namespace Tests\Unit\Jobs;

use App\Jobs\NotifyAllVoters;
use App\Mail\IdeaStatusUpdatedMailable;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\RefreshDatabase;

class NotifyAllVotersTest extends TestCase
{

    use RefreshDatabase;
   
    /** @test */
    public function it_sends_an_email_to_all_voters()
    {
        $user = User::factory()->create([ 'email'=>'user1@example.com']);
        $userB = User::factory()->create(['email' => 'user2@example.com']);

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

        Mail::fake();

        NotifyAllVoters::dispatch($idea1);

        Mail::assertQueued(IdeaStatusUpdatedMailable::class,function($mail){
            return $mail->hasTo('user1@example.com') 
                && $mail->build()->subject ==='An idea you voted for has a new status';
        });

        Mail::assertQueued(IdeaStatusUpdatedMailable::class, function ($mail) {
            return $mail->hasTo('user2@example.com') 
                && $mail->build()->subject === 'An idea you voted for has a new status';
        });


    }

}
