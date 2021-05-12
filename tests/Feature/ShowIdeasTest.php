<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
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
        $user = User::factory()->create();
        $category1 = Category::factory()->create(['name'=>'category1'] );
        $category2 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea1 = Idea::factory()->create([
            'user_id'=>$user->id,
            'title'=>'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        $idea2 = Idea::factory()->create([
            'user_id'=>$user->id,
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
        
       
        // $response->assertSee('<div class=" bg-gray-200  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Open</div>',false);

        $response->assertSee($idea2->title);
        $response->assertSee($idea2->description);
        $response->assertSee($category2->name);
        // $response->assertSee($statusConsidering->name);
        // $response->assertSee('<div class=" bg-purple text-white  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-4">Considering</div>',false);

    }

    /** @test */
    public function single_idea_shows_correctly_on_the_show_page()
    {

        $user = User::factory()->create();
        $category1 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'OpenUnique', 'classes' => ' bg-gray-200 ']);
        // $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);
        $idea = Idea::factory()->create([
            'user_id'=>$user->id,
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
        
        $response->assertSee($statusOpen->name);
        // $response->assertSee('<div class=" bg-gray-200  text-xxs font-bold uppercase leading-none rounded-full text-center w-28 h-7 py-2 px-3">Open</div>', false);

    }


    /** @test */
    public function ideas_pagination_works()
    {

        $user = User::factory()->create();

        $categoryOne = Category::factory()->create(['name' => 'Category 1']);

        $statusOpen = Status::factory()->create(['name' => 'OpenUnique', 'classes' => 'bg-gray-200']);

        Idea::factory(Idea::PAGINATION_COUNT + 1)->create([
            'user_id' => $user->id,
            'category_id' => $categoryOne->id,
            'status_id' => $statusOpen->id,
        ]);

        $ideaOne = Idea::find(1);
        $ideaOne->title = 'My First Idea';
        $ideaOne->save();

        $ideaEleven = Idea::find(11);
        $ideaEleven->title = 'My Eleventh Idea';
        $ideaEleven->save();

        $response = $this->get('/');

        $response->assertSee($ideaEleven->title);
        $response->assertDontSee($ideaOne->title);
        $response->assertSee($statusOpen->name);

        $response = $this->get('/?page=2');

        $response->assertSee($ideaOne->title);
        $response->assertDontSee($ideaEleven->title);

        $response->assertSee($statusOpen->name);

    }

    /** @test */
    public function same_idea_title_will_have_different_slugs()
    {

        $user = User::factory()->create();
        $category1 = Category::factory()->create(['name' => 'category1']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        $ideaOne = Idea::factory()->create([
            'user_id'=>$user->id,
            'title' => 'My first idea',
            'description' => 'Description of my first idea',
            'category_id' => $category1->id,
            'status_id' => $statusOpen->id
        ]);

        $ideaTwo = Idea::factory()->create([
            'user_id'=>$user->id,
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


    /** @test */
    public function in_app_back_button_works_when_index_page_vistied_first_idea()
    {
        $user = User::factory()->create();
        $category1 = Category::factory()->create(['name' => 'category 1']);
        $category2 = Category::factory()->create(['name' => 'category 2']);
        $statusOpen = Status::factory()->create(['name' => 'OpenUnique', 'classes' => ' bg-gray-200 ']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);
        
        $response = $this->get('/?category=category2&status=Considering');

        $response = $this->get(route('idea.show',$idea1));
        
        $this->assertStringContainsString( '/?category=category2&status=Considering', $response['backUrl']);
        
        // $response->assertDontSee($statusOpen->name);
        
        // dd($response['backUrl']);
        // $response = $this->get(route('idea.index'));


    }


    /** @test */
    public function in_app_back_button_works_when_show_page_only_vistied_first()
    {
        $user = User::factory()->create();
        $category1 = Category::factory()->create(['name' => 'category 1']);
        $category2 = Category::factory()->create(['name' => 'category 2']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);
        $statusConsidering = Status::factory()->create(['name' => 'Considering', 'classes' => ' bg-purple text-white ']);

        $idea1 = Idea::factory()->create([
            'user_id' => $user->id,
            'title' => 'My first idea',
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
            'description' => 'Description of my first idea',
        ]);

        // $response = $this->get('/?category=category2&status=Considering');

        $response = $this->get(route('idea.show', $idea1));

        $this->assertEquals(route('idea.index'), $response['backUrl']);
        // dd($response['backUrl']);
        // $response = $this->get(route('idea.index'));


    }

}
