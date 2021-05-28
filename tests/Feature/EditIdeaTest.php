<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use Livewire\Livewire;
use App\Models\Category;
use Illuminate\Http\Response;
use App\Http\Livewire\EditIdea;
use App\Http\Livewire\IdeaShow;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_edit_idea_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id"=>$user->id,
        ]);        

        $this->actingAs($user)
            ->get(route('idea.show',$idea))
            ->assertSeeLivewire('edit-idea');  
    }

    /** @test */
    public function does_not_shows_edit_idea_livewire_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $this->actingAs($user)
           ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('edit-idea');
    }


    /** @test */
    public function edit_idea_form_validation_works()
    {

        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);  

        Livewire::actingAs($user)
            ->test(EditIdea::class,['idea'=>$idea])      
            ->set('title', '')
            ->set('category', '')
            ->set('description', '')
            ->call('updateIdea')
            ->assertHasErrors(['title', 'category', 'description'])
            ->assertSee('The title field is required');
    }

    /** @test */
    public function editing_an_idea_works_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $idea = Idea::factory()->create([
            "user_id" => $user->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'my edited idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'my edited description')
            ->call('updateIdea')
            ->assertEmitted('ideaWasUpdated');

        $this->assertDatabaseHas('ideas',[
            'title'         => 'my edited idea',
            'category_id'   => $categoryTwo->id,
            'description'   => 'my edited description',
        ]);
    }

    /** @test */
    public function editing_an_idea_does_not_work_when_user_does_not_have_authorization_because_different_user_created_the_idea()
    {
        $user = User::factory()->create();
        $userB = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($userB)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'my edited idea')
            ->set('category', $categoryTwo->id)
            ->set('description', 'my edited description')
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);

       
    }

    /** @test */
    public function editing_an_idea_does_not_work_when_user_does_not_have_authorization_because_idea_was_create_over_an_hour_ago()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        Carbon::setTestNow(now()->addHour());

        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'my edited idea')
            ->set('category', 1)
            ->set('description', 'my edited description')
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);

        Carbon::setTestNow(now()->addHours(2));

        Livewire::actingAs($user)
            ->test(EditIdea::class, ['idea' => $idea])
            ->set('title', 'my edited idea')
            ->set('category',1)
            ->set('description', 'my edited description')
            ->call('updateIdea')
            ->assertStatus(Response::HTTP_FORBIDDEN);
    }

    /** @test */
    public function editing_an_idea_shows_on_menu_when_user_has_authorizaion()
    {

        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount'=> 2,
            ])
            ->assertSee('Edit Idea');

    }

    /** @test */
    public function editing_an_idea_does_not_show_on_menu_when_user_does_not_have_authorizaion()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 2,
            ])
            ->assertDontSee('Edit Idea');
    }


}
