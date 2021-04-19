<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    // public $ideas;
    use WithPagination;

    public function mouted()
    {
        
    }



    public function render()
    {
        $ideas = Idea::with('category', 'user', 'status')
            ->withCount('votes')
            ->withVotedByUser(auth()->user())
            ->orderBy('id', 'desc')
            ->simplePaginate(Idea::PAGINATION_COUNT);
        return view('livewire.ideas-index',['ideas'=>$ideas]);
    }
}
