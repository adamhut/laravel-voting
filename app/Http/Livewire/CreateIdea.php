<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Vote;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Response;

class CreateIdea extends Component
{

    public $title;
    public $category = 1 ;
    public $description = '';

    public $rules = [
        'title'=>'required|min:4',
        'category' => 'required|integer',
        'description' => 'required|min:4',
    ];


    public function createIdea()
    {
        if(!auth()->check())
        {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $idea = Idea::create([
            'user_id'       => auth()->user()->id,
            'title'         => $this->title,
            'category_id'   => $this->category,
            'status_id'     => 1,   //open
            'description'   => $this->description,
        ]);

        $idea->vote(auth()->user());
        // Vote::create([
        //     'idea_id' => $idea->id,
        //     'user_id' => auth()->user()->id,
        // ]);

        session()->flash('success_message', 'Idea was added successfully');

        $this->reset();

        return redirect()->route('idea.index');            

      
    }
   





    public function render()
    {
     
        return view('livewire.create-idea',[
            'categories' => Category::get(),
        ]);
    }
}
