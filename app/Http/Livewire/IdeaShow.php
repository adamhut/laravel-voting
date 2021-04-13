<?php

namespace App\Http\Livewire;

use App\Models\Idea;
use Livewire\Component;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;

class IdeaShow extends Component
{
    public $idea;
    public $votesCount;
    public $hasVoted;


    public function mount(Idea $idea,$votesCount)
    {
        
        $this->idea = $idea;
        $this->votesCount = $votesCount;
        $this->hasVoted = $idea->isVotedByUser(auth()->user());
    }

    public function vote()
    {
        if(!auth()->check())
        {
            return redirect(route('login'));
        }

        if ($this->hasVoted) {
            try {
                //code...
                $this->idea->removeVote(auth()->user());
            } catch (VoteNotFoundException $e) {
                //do not thing
            }
           
            $this->votesCount--;

            $this->hasVoted = false;
        } else {

            try {
                //code...
                $this->idea->vote(auth()->user());
            } catch (DuplicateVoteException $e) {
                //do not thing
            }
            
            $this->votesCount++;

            $this->hasVoted = true;
        }

    }

    public function render()
    {
        return view('livewire.idea-show');
    }
}
