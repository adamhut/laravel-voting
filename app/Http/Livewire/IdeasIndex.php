<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use App\Models\Status;
use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class IdeasIndex extends Component
{
    // public $ideas;
    use WithPagination;

    public $status = 'All';
    public $category = '';


    protected $queryString = [
        'status',
        'category'
    ];

    protected $listeners =[
        'queryStringUpdatedStatus'=> 'queryStringUpdatedStatus',
        //queryStringUpdatedStatus //or just htis 
    ];

    public function mouted()
    {
        $this->status = request()->get('status', 'All');
        // $this->category = request()->get('status', 'All Categories');
    }

    // public function updatingStatus()
    // {
    //     $this->resetPage();
    // }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function queryStringUpdatedStatus($newStatus)
    {
        $this->status = $newStatus;
        $this->resetPage();
    }

    public function render()
    {
        $statuses = Status::pluck('id','name');
        $categories= Category::select(['id','name'])->get();
        // dd($statuses);
        $ideas = Idea::with('category', 'user', 'status')
            ->withCount('votes')
            ->withVotedByUser(auth()->user())
            // ->when(request()->has('status') && request()->status !=='All',function($query) use($statuses){
            //     return $query->where('status_id', $statuses->get(request()->status));
            // })   
            ->when($this->status && $this->status !== 'All', function ($query) use ($statuses) {
                return $query->where('status_id', $statuses->get($this->status));
            })
            ->when($this->category && $this->category !== 'All Categories', function ($query) use ($categories) {
                return $query->where('category_id', $categories->pluck('id','name')->get($this->category));
            })      
            ->orderBy('id', 'desc')
            ->simplePaginate(Idea::PAGINATION_COUNT);
        return view('livewire.ideas-index',[
            'ideas'=>$ideas,
            'categories'=> $categories,
        ]);
    }
}
