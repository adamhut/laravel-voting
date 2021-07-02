<?php

namespace Tests\Feature\Comments;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\EditComment;
use App\Http\Livewire\IdeaComment;
use App\Http\Livewire\DeleteComment;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteCommentTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_delete_comment_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();        

        $this->actingAs($user)
            ->get(route('idea.show',$idea))
            ->assertSeeLivewire('edit-comment');  
    }

    /** @test */
    public function does_not_shows_delete_comment_livewire_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('edit-comment');
    }

    
    /** @test */
    public function delete_comment_is_set_correctly_when_user_click_it_from_menu()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $comment = Comment::factory()->create([
            'idea_id'=>$idea->id,
            'user_id' => $user->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::actingAs($user)
            ->test(DeleteComment::class)
            ->call('setDeleteComment',$comment->id)
            ->assertEmitted('deleteCommentWasSet');


    }



    /** @test */
    public function delete_an_comment_works_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $idea = Idea::factory()->create([
            "user_id" => $user->id
        ]);
        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
        ]);
      

        Livewire::actingAs($user)
            ->test(DeleteComment::class)
            ->call('setDeleteComment', $comment->id)
            ->call('deleteComment')
            ->assertEmitted('commentWasDeleted');

        $this->assertCount(0,Comment::get());
    }

    /** @test */
    public function delete_an_comment_does_not_work_when_user_does_not_have_authorization_because_different_user_created_the_comment()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::actingAs($user)
            ->test(DeleteComment::class)
            ->call('setDeleteComment', $comment->id)
            ->call('deleteComment')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        Livewire::test(DeleteComment::class)
            ->call('setDeleteComment', $comment->id)
            ->call('deleteComment')
            ->assertStatus(Response::HTTP_FORBIDDEN);

       
    }

  
    /** @test */
    public function deleting_an_comment_shows_on_menu_when_user_does_have_authorizaion()
    {

        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::actingAs($user)
            ->test(IdeaComment::class,[
                'comment' =>$comment,
                'ideaUserId'=>$idea->user_id
            ])
            ->assertSee('Delete Comment');

    }

    /** @test */
    public function deleting_an_comment_does_not_show_on_menu_when_user_does_not_have_authorizaion()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        $comment = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body' => 'This is my first comment',
        ]);

        Livewire::test(IdeaComment::class, [
                'comment' => $comment,
                'ideaUserId' => $idea->user_id
            ])
            ->assertDontSee('Delete Comment');
    }

    



}
