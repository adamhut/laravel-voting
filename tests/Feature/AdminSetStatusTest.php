<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\SetStatus;
use App\Jobs\NotifyAllVoters;
use Illuminate\Support\Facades\Queue;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdminSetStatusTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function show_page_contains_set_status_lievewire_component_when_user_is_admin()
    {
        $user   = User::factory()->create([
            'email'=>'adamhut@gmail.com'
        ]);

        

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', ]);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show',$idea))
            ->assertSeeLivewire('set-status');



    }

    /** @test */
    public function show_page_does_not_contains_set_status_lievewire_component_when_user_is_admin()
    {
        $user   = User::factory()->create([
            'email' => 'not_admin@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $categoryTwo = Category::factory()->create(['name' => 'category2']);

        $statusOpen = Status::factory()->create(['name' => 'Open', ]);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $this->actingAs($user)
            ->get(route('idea.show', $idea))
            ->assertDontSeeLivewire('set-status');
    }

    /** @test */
    public function  initial_status_is_set_correctlly()
    {
        $user   = User::factory()->create([
            'email' => 'not_admin@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusConsirering = Status::factory()->create(['name' => 'Considering', ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusConsirering->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class,[
                'idea' =>$idea, 
            ])
            ->assertSet('status', $statusConsirering->id);
    }

    /** @test */
    public function can_set_status_correctlly()
    {
        $user   = User::factory()->create([
            'email' => 'adamhut@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusConsirering = Status::factory()->create(['id'=>2,'name' => 'Considering', ]);
        $statusInProgress  = Status::factory()->create(['id'=>3,'name' => 'In Progress', ]);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusConsirering->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea,
            ])
            ->set('status',$statusInProgress->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated');

        $this->assertDatabaseHas('ideas',[
            'id' => $idea->id,
            'status_id' =>$statusInProgress->id,
        ]);
    }

    /** @test */
    public function can_set_status_correctlly_while_notifing_all_voters()
    {
        $user   = User::factory()->create([
            'email' => 'adamhut@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusConsirering = Status::factory()->create(['id' => 2, 'name' => 'Considering']);
        $statusInProgress  = Status::factory()->create(['id' => 3, 'name' => 'In Progress']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusConsirering->id,
            'description' => 'Description of my first idea',
        ]);
        
        Queue::fake();

        Queue::assertNothingPushed();

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea,
            ])
            ->set('status', $statusInProgress->id)
            ->set('notifyAllVoters',true)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated');

        Queue::assertPushed(NotifyAllVoters::class);

    }

    /** @test */
    public function can_set_status_correctlly_no_comment()
    {
        $user   = User::factory()->create([
            'email' => 'adamhut@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusConsirering = Status::factory()->create(['id' => 2, 'name' => 'Considering' ]);
        $statusInProgress  = Status::factory()->create(['id' => 3, 'name' => 'In Progress']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusConsirering->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea,
            ])
            ->set('status', $statusInProgress->id)
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated');

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusInProgress->id,
            
        ]);

        $this->assertDatabaseHas('comments', [
            'idea_id' => $idea->id,
            'status_id' => $statusInProgress->id,
            'body' => 'No comment was added',
            'is_status_update' => 1,
        ]);
    }

    /** @test */
    public function can_set_status_correctlly_with_comment()
    {
        $user   = User::factory()->create([
            'email' => 'adamhut@gmail.com'
        ]);

        $categoryOne = Category::factory()->create(['name' => 'category1']);
        $statusConsirering = Status::factory()->create(['id' => 2, 'name' => 'Considering']);
        $statusInProgress  = Status::factory()->create(['id' => 3, 'name' => 'In Progress']);

        $idea = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $categoryOne->id,
            'status_id'     =>  $statusConsirering->id,
            'description' => 'Description of my first idea',
        ]);

        Livewire::actingAs($user)
            ->test(SetStatus::class, [
                'idea' => $idea,
            ])
            ->set('status', $statusInProgress->id)
            ->set('comment', 'This is a comment')
            ->call('setStatus')
            ->assertEmitted('statusWasUpdated');

        $this->assertDatabaseHas('ideas', [
            'id' => $idea->id,
            'status_id' => $statusInProgress->id,

        ]);

        $this->assertDatabaseHas('comments', [
            'idea_id' => $idea->id,
            'status_id' => $statusInProgress->id,
            'body' => 'This is a comment',
            'is_status_update' => 1,
        ]);
    }


}
