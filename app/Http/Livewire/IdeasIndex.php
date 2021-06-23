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

    public $filter = '';
    public $search = '';


    protected $queryString = [
        'status',
        'category',
        'filter',
        'search'
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

    public function updatedFilter()
    {
        if($this->filter ==='My Ideas' && !auth()->check())
        {
            return redirect()->route('login');
        }
    }

    public function updatingCategory()
    {
        $this->resetPage();
    }

    public function updatingFilter()
    {
        $this->resetPage();
    }

    public function updatingSearch()
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
            ->withCount('comments')
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
            ->when($this->filter  && $this->filter === 'Top Voted',  function ($query) {
                return $query->orderByDesc('votes_count');
            }) 
            ->when($this->filter && auth()->check() && $this->filter === 'My Ideas',  function ($query) {
                return $query->where('user_id',auth()->user()->id);
            })
            ->when($this->filter && auth()->check() && $this->filter === 'Spam Ideas',  function ($query) {
                return $query->where('spam_reports','>',0)->orderBy('spam_reports','desc');
            })
            ->when($this->search  && strlen($this->search) >=  '3',  function ($query) {
                return $query->where('title','like','%'.$this->search.'%');
            })               
            ->orderBy('id', 'desc')
            ->simplePaginate()
            ->withQueeryString();
        return view('livewire.ideas-index',[
            'ideas'=>$ideas,
            'categories'=> $categories,
        ]);
    }
}
