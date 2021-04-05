<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\Status;
use App\Models\Category;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ShowIdeasTest extends TestCase
{
    use RefreshDatabase;


    /** @test */
    public function it_list_of_ideas_show_on_main_page()
    {
        $category1 = Category::factory()->create(['name'=>'category1'] );
        $category2 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);
        $idea1 = Idea::factory()->create([
            'title'=>'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $idea2 = Idea::factory()->create([
            'title'=>'My second idea',
            'category_id' => $category2->id,

            'status_id'     =>  $statusConsidering->id,
            'description' => 'Description of my second idea',
        ]);

        $response = $this->get(route('idea.index'));

        $response->assertSuccessful();

        $response->assertSee($idea1->title);
        $response->assertSee($idea1->description);
        $response->assertSee($category1->name);
        // $response->assertSee($statusOpen->name);
        
       
        $response->assertSee('<div class=" bg-gray-200  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>',false);

        $response->assertSee($idea2->title);
        $response->assertSee($idea2->description);
        $response->assertSee($category2->name);
        // $response->assertSee($statusConsidering->name);
        $response->assertSee('<div class=" bg-purple text-white  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Considering</div>',false);

    }

    /** @test */
    public function single_idea_shows_correctly_on_the_show_page()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);
        $idea = Idea::factory()->create([
            'title' => 'My first idea',
            'category_id' => $category1->id,
            'status_id'     => $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);


        $response = $this->get(route('idea.show',['idea'=>$idea->slug]));

        $response->assertSuccessful();

        $response->assertSee($idea->title);
        $response->assertSee($idea->description);

        $response->assertSee($category1->name);
        // $response->assertSee($statusOpen->name);
        $response->assertSee('<div class=" bg-gray-200  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-3">Open</div>', false);

    }


    /** @test */
    public function ideas_pagination_works()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        Idea::factory(Idea::PAGINATION_COUNT+1)->create([
            'category_id' => $category1->id,
            'status_id' => $statusOpen->id
        ]);

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'My First Idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'My Eleventh Idea';
        $ideaEleven->save();

        $response = $this->get(route('idea.index'));

        $this->assertCount(11,Idea::all());
        $response->assertSee($ideaOne->title);
        $response->assertSee($category1->name);
        $response->assertDontSee($ideaEleven->title);
        // $response->assertSee($statusOpen->name);
        $response->assertSee('<div class=" bg-gray-200  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>', false);


        $response = $this->get('/?page=2');
        $response->assertSee($ideaEleven->title);
        $response->assertDontSee($ideaOne->title);

    }

    /** @test */
    public function same_idea_title_will_have_different_slugs()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        $ideaOne = Idea::factory()->create([
            'title' => 'My first idea',
            'description' => 'Description of my first idea',
            'category_id' => $category1->id,
            'status_id' => $statusOpen->id
        ]);

        $ideaTwo = Idea::factory()->create([
            'title' => 'My first idea',
            'description' => 'Description of my first idea',
            'status_id' => $statusOpen->id,
            'category_id' => $category1->id
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