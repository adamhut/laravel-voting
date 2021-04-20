<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
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
        $statuses = Status::pluck('id','name');
        // dd($statuses);
        $ideas = Idea::with('category', 'user', 'status')
            ->withCount('votes')
            ->withVotedByUser(auth()->user())
            ->when(request()->has('status') && request()->status !=='All',function($query) use($statuses){
                return $query->where('status_id', $statuses->get(request()->status));
            })            
            ->orderBy('id', 'desc')
            ->simplePaginate(Idea::PAGINATION_COUNT);
        return view('livewire.ideas-index',['ideas'=>$ideas]);
    }
}
