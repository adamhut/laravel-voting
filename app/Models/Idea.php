<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
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
