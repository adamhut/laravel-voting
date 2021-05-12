<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Models\Category;

class EditIdea extends Component
{

    public $idea;
    // public $categories;


    public function mount(Idea $idea)
    {
        $this->idea = $idea;
    }


    public function render()
    {
        return view('livewire.edit-idea',[
            'categories' => Category::get(),
        ]);
    }
}
