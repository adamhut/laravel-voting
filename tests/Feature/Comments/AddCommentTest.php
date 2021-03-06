<?php

namespace Tests\Feature\Comments;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;
use App\Http\Livewire\AddComment;
use App\Notifications\CommentAdded;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\Notification;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AddCommentTest extends TestCase
{
    use RefreshDatabase, WithFaker;


    /** @test */
    public function add_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $response = $this->get(route('idea.show',$idea));

        $response->assertSeeLivewire('add-comment');
    }

    /** @test */
    public function add_comment_form_renders_when_user_is_logged_in()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();



        $response = $this->actingAs($user)
            ->get(route('idea.show', $idea));

        $response->assertSee('Share your thoughts');
    }

    /** @test */
    public function add_comment_form_does_not_render_when_user_is_logged_out()
    {
        $idea = Idea::factory()->create();

        $comment  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my first comment'
        ]);

        $response = $this->get(route('idea.show', $idea));

        $response->assertSee('Please Login or create an account to post a comment');
    }



    /** @test */
    public function add_comment_form_valiation_work()
    {
        $user = User::factory()->create();

        $idea = Idea::factory()->create();

        $comment  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my first comment'
        ]);

        Livewire::actingAs($user)
            ->test(AddComment::class,['idea'=>$idea])
            ->set('comment','')
            ->call('addComment')
            ->assertHasErrors(['comment']);

        Livewire::actingAs($user)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', '333')
            ->call('addComment')
            ->assertHasErrors(['comment']);

    }

    /** @test */
    public function add_comment_form_works()
    {

        Notification::fake();

        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        Notification::assertNothingSent();

        $comment =  'This is my first comment';
        Livewire::actingAs($user)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment',$comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');


        Notification::assertSentTo(
            [$idea->user],CommentAdded::class
        );
        $this->assertEquals(1, $idea->fresh()->comments()->count());

        $this->assertEquals($comment,Comment::first()->body);

    }







}
