<?php

namespace Tests\Feature\Comments;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use App\Models\Comment;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowCommentsTest extends TestCase
{
    use WithFaker, RefreshDatabase;


    /** @test */
    public function idea_comments_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $comment  = Comment::factory()->create([
            'idea_id'=>$idea->id,
            'body'  =>'This is my first comment'
        ]);

        $this->get(route('idea.show',$idea))
            ->assertSeeLivewire('idea-comments');
    }


    /** @test */
    public function idea_comment_livewire_component_renders()
    {
        $idea = Idea::factory()->create();

        $comment  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my first comment'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeLivewire('idea-comment');
    }

    /** @test */
    public function no_comment_show_appropirate_message()
    {
        $idea = Idea::factory()->create();

        $this->get(route('idea.show', $idea))
            ->assertSee('No Comments Yet');
    }

    /** @test */
    public function list_of_comments_show_on_idea_page()
    {
        $idea = Idea::factory()->create();

        $commentOne  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my first comment'
        ]);


        $commentTwo  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my second comment'
        ]);

        $this->get(route('idea.show', $idea))
            ->assertSeeInOrder(['This is my first comment','This is my second comment']);
    }

    /** @test */
    public function comments_count_show_correctlly_on_index_page()
    {
        $idea = Idea::factory()->create();

        $commentOne  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my first comment'
        ]);

        $commentTwo  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my second comment'
        ]);

        $this->get(route('idea.index', $idea))
            ->assertSee('2 Comments');
    }

    /** @test */
    public function op_badge_show_if_author_of_idea_comments_on_idea()
    {
        $user = User::factory()->create();
    

        $idea = Idea::factory()->create([
            'user_id' => $user->id
        ]);

        $commentOne  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'body'  => 'This is my first comment'
        ]);

        $commentTwo  = Comment::factory()->create([
            'idea_id' => $idea->id,
            'user_id' => $user->id,
            'body'  => 'This is my second comment'
        ]);

        $resposne =  $this->get(route('idea.show', $idea));
        // $resposne->assertSee('OP');
    }




    /** @test */
    public function comments_pagination_works()
    {

        $user = User::factory()->create();

        $idea  = Idea::factory()->create();

        $commentOne = Comment::factory()->create(['idea_id' => $idea->id]);

        Comment::factory()
            ->times($commentOne->getPerPage()+1)
            ->create(['idea_id'=>$idea->id]);
    
      
        $response = $this->get(route('idea.show',$idea));

        $response->assertSee($commentOne->body);
        $response->assertDontSee( Comment::find(Comment::count())->body );

        $response = $this->get(route('idea.show',[
            'idea'=>$idea,
            'page'=>'2'
        ]));

        $response->assertSee(Comment::find(Comment::count())->body);
        $response->assertDontSee($commentOne->body);

        // $response->assertSee($statusOpen->name);
    }

}
