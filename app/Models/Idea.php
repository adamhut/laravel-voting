<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Exceptions\VoteNotFoundException;
use App\Exceptions\DuplicateVoteException;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Idea extends Model 
{
    use HasFactory, Sluggable;

    const PAGINATION_COUNT = 10;

    protected $guarded = [];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function votes()
    {
        return $this->belongsToMany(User::class,'votes');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function vote(User $user)
    {
        if($this->isVotedByUser($user))        
        {
            throw new DuplicateVoteException;
        }

        Vote::create([
            'idea_id'=>$this->id,
            'user_id' => $user->id,
        ]);
    }

    public function removeVote(User $user)
    {
        
        $voteToDelete = Vote::where('idea_id',$this->id)
            ->where('user_id',$user->id)
            ->first();
        
        if(!$voteToDelete)
        {
            throw new VoteNotFoundException();
        }

        $voteToDelete->delete();
        // Vote::where('idea_id',$this->id)
        //     ->where('user_id',$user->id)
        //     ->firstOrFail()
        //     ->delete();
    }   

    public function isVotedByUser(User $user=null)
    {
        if(!$user){
            return false;
        }


        return Vote::where('idea_id',$this->id)
            ->where('user_id',$user->id)
            ->exists();

        // return true;
    }

    public function scopeWithVotedByUser($query,User $user=null)
    {
     
        if (!$user) {
            return $query;
        }
       
        return $query->addSelect([
            'voted_by_user' => Vote::select('id')
            ->whereColumn('idea_id', 'ideas.id')
            ->where('user_id', $user->id)
            ->limit(1)
        ]);

    }


    /**
     * Return the sluggable configuration array for this model.
     *
     * @return array
     */
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }


    public function getStatusClasses()
    {
        
        // $allSatatuses =[
        //     'Open'          => ' bg-gray-200 ',
        //     'Considering'   => ' bg-purple text-white ',
        //     'In Progress'   => ' bg-yellow text-white ',
        //     'Closed'        => ' bg-red text-white ',
        //     'Implemented'   => ' bg-green text-white ',
        // ];

        // return array_key_exists($this->status->name, $allSatatuses) ?  $allSatatuses[$this->status->name]:' bg-gray-200 ';

    }

}
