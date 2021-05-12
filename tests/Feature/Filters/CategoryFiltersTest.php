<?php

namespace Tests\Feature\Filters;

use Tests\TestCase;
use App\Models\Idea;
use App\Models\User;
use App\Models\Status;
use Livewire\Livewire;
use App\Models\Category;
use App\Http\Livewire\IdeasIndex;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryFiltersTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function selecting_a_category_filter_correctly()
    {

        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);

        $idea1 = Idea::factory()->create([
            'category_id'   => $category1->id,
        ]);

        $idea2 = Idea::factory()->create([
            'category_id' => $category1->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', 'category1')
            ->assertViewHas('ideas',function($ideas){
                return $ideas->count()===2 
                    && $ideas->first()->category->name =='category1';
            });

    }

    /** @test */
    public function the_category_query_string_filters_correctly()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);
       
        $idea1 = Idea::factory()->create([
            'category_id'   => $category1->id,
        ]);

        $idea2 = Idea::factory()->create([
            'category_id' => $category1->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
        ]);

        Livewire::withQueryParams(['category'=> 'category1'])
            ->test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 2
                    && $ideas->first()->category->name == 'category1';
            });
    }


    /** @test */
    public function selecting_a_status_and_a_category_filters_correctly()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);

        
        $idea1 = Idea::factory()->create([
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
        ]);

        $idea2 = Idea::factory()->create([
            'category_id' => $category1->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
            'status_id'     =>  $statusOpen->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->set('category', 'category1')
            ->set('status', 'Open')
            ->assertViewHas('ideas', function ($ideas) use($idea1){
                return $ideas->count() === 1
                    && $ideas->first()->category->name == 'category1'
                    && $ideas->first()->status->name == 'Open' ;
            });        
    }


    /** @test */
    public function the_category_query_string_filters_correctly_with_status_and_category()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);

       
        Idea::factory()->create([
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id
        ]);

        Idea::factory()->create([
            'category_id' => $category1->id
        ]);

        Idea::factory()->create([
            'category_id' => $category2->id,
            'status_id'     =>  $statusOpen->id
        ]);

        Idea::factory()->create([
            'category_id' => $category2->id
        ]);

        Livewire::withQueryParams([
                'category'=> 'category1', 
                'status'=> 'Open'
            ])
            ->test(IdeasIndex::class)
          
            ->assertViewHas('ideas', function ($ideas){
                return $ideas->count() === 1
                    && $ideas->first()->category->name == 'category1'
                    && $ideas->first()->status->name == 'Open';
            });
    }

     /** @test */
    public function the_category_query_string_filters_correctly_with_status_and_category_query_param()
    {
        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);
        $statusOpen = Status::factory()->create(['name' => 'Open', 'classes' => ' bg-gray-200 ']);

        $idea1 = Idea::factory()->create([
            'category_id'   => $category1->id,
            'status_id'     =>  $statusOpen->id,
        ]);

        $idea2 = Idea::factory()->create([
            'category_id' => $category1->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
            'status_id'     =>  $statusOpen->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
        ]);

        Livewire::withQueryParams([
                'category'=> 'category1', 
                'status'=> 'Open'
            ])
            ->test(IdeasIndex::class)
          
            ->assertViewHas('ideas', function ($ideas) use ($idea1) {
                return $ideas->count() === 1
                    && $ideas->first()->category->name == 'category1'
                    && $ideas->first()->status->name == 'Open';
            });
    }

    /** @test */
    public function selecting_all_category_filter_correctly()
    {

        $category1 = Category::factory()->create(['name' => 'category1']);
        $category2 = Category::factory()->create(['name' => 'category2']);
      
        $idea1 = Idea::factory()->create([
            'category_id'   => $category1->id,
        ]);

        $idea2 = Idea::factory()->create([
            'category_id' => $category1->id,
        ]);

        $idea3 = Idea::factory()->create([
            'category_id' => $category2->id,
        ]);

        Livewire::test(IdeasIndex::class)
            ->assertViewHas('ideas', function ($ideas) {
                return $ideas->count() === 3;
            });
    }



}
