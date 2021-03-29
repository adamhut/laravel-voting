<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_list_of_ideas_show_on_main_page()
    {
        $idea1 = Idea::factory()->create([
            'title'=>'My first idea',
            'description' => 'Description of my first idea',
        ]);

        $idea2 = Idea::factory()->create([
            'title'=>'My second idea',
            'description' => 'Description of my second idea',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($idea1->title);
        $response->assertSee($idea1->description);
        $response->assertSee($idea2->title);
        $response->assertSee($idea2->description);
    }

    /** @test */
    public function single_idea_shows_correctly_on_the_show_page()
    {
        $idea = Idea::factory()->create([
            'title' => 'My first idea',
            'description' => 'Description of my first idea',
        ]);


        $response = $this->get(route('idea.show',['idea'=>$idea->slug]));

        $response->assertSuccessful();

        $response->assertSee($idea->title);
        $response->assertSee($idea->description);
    }


    /** @test */
    public function ideas_pagination_works()
    {
        Idea::factory(Idea::PAGINATION_COUNT+1)->create();

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'My First Idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'My Eleventh Idea';
        $ideaEleven->save();

        $response = $this->get(route('idea.index'));

        $this->assertCount(11,Idea::all());
        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaEleven->title);

        $response = $this->get('/?page=2');
        $response->assertSee($ideaEleven->title);
        $response->assertDontSee($ideaOne->title);

    }

    /** @test */
    public function same_idea_title_will_have_different_slugs()
    {
        $ideaOne = Idea::factory()->create([
            'title' => 'My first idea',
            'description' => 'Description of my first idea',
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My first idea',
            'description' => 'Description of my first idea',
        ]);

        $response = $this->get(route('idea.show',['idea'=>$ideaOne->slug]));

        $response->assertSuccessful();

        $this->assertTrue(request()->path() == 'ideas/my-first-idea');

        $response = $this->get(route('idea.show', ['idea' => $ideaTwo->slug]));

        $response->assertSuccessful();

        // dd(request()->path());
        $this->assertTrue(request()->path() == 'ideas/my-first-idea-2');



    }

}
