<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Vote;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeaShow;
use App\Http\Livewire\DeleteIdea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteIdeaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function shows_delete_idea_livewire_component_when_user_has_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertSeeLivewire('delete-idea');
    }

    /** @test */
    public function does_not_show_delete_idea_livewire_component_when_user_does_not_have_authorization()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('delete-idea');
    }


   

    /** @test */
    public function deleting_an_idea_works_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $idea = Idea::factory()->create([
            "user_id" => $user->id,
            'category_id' => $categoryOne->id
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, ['idea' => $idea])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

       $this->assertCount(0 ,Idea::get());
    }

    /** @test */
    public function deleting_an_idea_with_votes_works_when_user_has_authorization()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'category1']);
       
        

        $idea = Idea::factory()->create([
            "user_id" => $user->id,
            'category_id' => $categoryOne->id
        ]);

        Vote::factory()->create([
            'user_id' => $user->id,
            'idea_id' => $idea->id,
        ]);

        Livewire::actingAs($user)
            ->test(DeleteIdea::class, ['idea' => $idea])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertCount(0, Idea::get());
        $this->assertCount(0, Vote::get());
    }


    /** @test */
    public function deleting_an_idea_works_when_user_is_an_admin()
    {
        $admin = User::factory()->admin()->create();
       
        $idea = Idea::factory()->create();

        Livewire::actingAs($admin)
            ->test(DeleteIdea::class, ['idea' => $idea])
            ->call('deleteIdea')
            ->assertRedirect(route('idea.index'));

        $this->assertCount(0, Idea::get());
    }



    /** @test */
    public function deleting_an_idea_shows_on_menu_when_user_has_authorizaion()
    {

        $user = User::factory()->create();
        $idea = Idea::factory()->create([
            "user_id" => $user->id,
        ]);

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 2,
            ])
            ->assertSee('Delete Idea');
    }

    /** @test */
    public function deleting_an_idea_does_not_show_on_menu_when_user_does_not_have_authorizaion()
    {
        $user = User::factory()->create();
        $idea = Idea::factory()->create();

        Livewire::actingAs($user)
            ->test(IdeaShow::class, [
                'idea' => $idea,
                'votesCount' => 2,
            ])
            ->assertDontSee('Delete Idea');
    }

}
