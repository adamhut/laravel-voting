<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Http\Response;

class EditIdea extends Component
{

    public $idea;
    
    public $title;
    public $category ;
    public $description;

    public $rules = [
        'title' => 'required|min:4',
        'category' => 'required|integer|exists:categories,id',
        'description' => 'required|min:4',
    ];


    public function mount(Idea $idea)
    {
        $this->idea = $idea;
        $this->title = $this->idea->title;
        $this->category = $this->idea->category_id;
        $this->description = $this->idea->description;

    }

    public function updateIdea()
    {
        
        if (auth()->guest() || auth()->user()->cannot('update',$this->idea)) {
            abort(Response::HTTP_FORBIDDEN);
        }

        $this->validate();

        $this->idea->update([
            'title'         => $this->title,
            'category_id'   => $this->category,
            'description'   => $this->description,
        ]);
        
        // session()->flash('success_message', 'Idea was updated successfully');

        // $this->reset();
        $this->emit('ideaWasUpdated','Idea was updated successfully!');
        return;
        // return redirect()->route('idea.index');    
    }


    public function render()
    {
        return view('livewire.edit-idea',[
            'categories' => Category::get(),
        ]);
    }
}
