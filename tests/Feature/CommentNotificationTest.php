<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Comment;
use App\Http\Livewire\AddComment;
use App\Http\Livewire\CommentNotifications;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Notifications\DatabaseNotification;

class CommentNotificationTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function comment_notification_livewire_component_renders_when_user_login()
    {
        $user = User::factory()->create();

        $response = $this->actingAs($user)->get(route('idea.index'));

        $response->assertSeeLivewire('comment-notifications');
    }

    /** @test */
    public function comment_notification_livewire_component_does_not_render_when_user_not_login()
    {
        $response = $this->get(route('idea.index'));

        $response->assertDontSeeLivewire('comment-notifications');
    }

    /** @test */
    public function notifications_show_for_logged_in_user()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        $comment =  'This is the first comment';
        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');
        // sleep(1);
        Livewire::actingAs($userBCommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', 'This is the second comment')
            ->call('addComment')
            ->assertEmitted('commentWasAdded');

        DatabaseNotification::first()->update(['created_at'=>now()->subMinute()]);

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->assertSee($comment)
            ->assertSee('This is the second comment')
            ->assertSeeInOrder(['This is the second comment', $comment])
            ->assertSet('notificationCount',2);

        $this->assertCount(2, DatabaseNotification::get());

    }

    /** @test */
    public function notification_count_greatr_than_threshold_shows_for_loggin_user()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        $comment =  'This is the first comment';
        $threshhold = CommentNotifications::NOTIFICATION_COUNT_THRESHOLD;

        foreach (range(1, $threshhold+10) as $val) {
            # code...
            Livewire::actingAs($userACommenting)
                ->test(AddComment::class, ['idea' => $idea])
                ->set('comment', $comment)
                ->call('addComment')
                ->assertEmitted('commentWasAdded');
        }

        $notificationCount = $threshhold.'+';

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('getNotifications')
            ->assertSet('notificationCount', $notificationCount)
            ->assertSee($notificationCount);

        // $this->assertCount(2, DatabaseNotification::get());
    }

    /** @test */
    public function can_mark_all_notification_as_read()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        $comment =  'This is the first comment';
        $threshhold = (new Comment)->getPerPage();

        # code...
        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');
        Livewire::actingAs($userBCommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');



        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('markAllAsRead');

        $this->assertEquals(0 ,$user->fresh()->unreadNotifications()->count());

        // $this->assertCount(2, DatabaseNotification::get());
    }


    /** @test */
    public function can_mark_individual_notification_as_read()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();
        $userBCommenting = User::factory()->create();

        $comment =  'This is the first comment';
        $threshhold = (new Comment)->getPerPage();

        # code...
        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');
        Livewire::actingAs($userBCommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');



        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('markAsRead',DatabaseNotification::first()->id)
            ->assertRedirect(route('idea.show',['idea'=>$idea,'page'=>'1']));

        $this->assertEquals(1, $user->fresh()->unreadNotifications()->count());

        // $this->assertCount(2, DatabaseNotification::get());
    }


    /** @test */
    public function notification_idea_deleted_redirect_to_index_page()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();

        $comment =  'This is the first comment';
        $threshhold = (new Comment)->getPerPage();

        # code...
        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');

        // $idea->comments()->delete();
        $idea->delete();

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('markAsRead', DatabaseNotification::first()->id)
            ->assertRedirect(route('idea.index'));

        // $this->assertEquals(1, $user->fresh()->unreadNotifications()->count());

        // $this->assertCount(2, DatabaseNotification::get());
    }


    /** @test */
    public function notification_comment_deleted_redirect_to_index_page()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            'user_id' => $user->id,
        ]);

        $userACommenting = User::factory()->create();

        $comment =  'This is the first comment';
        $threshhold = (new Comment)->getPerPage();

        # code...
        Livewire::actingAs($userACommenting)
            ->test(AddComment::class, ['idea' => $idea])
            ->set('comment', $comment)
            ->call('addComment')
            ->assertEmitted('commentWasAdded');

        $idea->comments()->delete();
        // $idea->delete();

        Livewire::actingAs($user)
            ->test(CommentNotifications::class)
            ->call('markAsRead', DatabaseNotification::first()->id)
            ->assertRedirect(route('idea.index'));

        // $this->assertEquals(1, $user->fresh()->unreadNotifications()->count());

        // $this->assertCount(2, DatabaseNotification::get());
    }


}
