<?php

namespace App\Models;

use App\Models\Idea;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function ideas()
    {
        return $this->hasMany(Idea::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function votes()
    {
        // return $this->hasMany(Vote::class);

        return $this->belongsToMany(Idea::class,'votes');
    }

    public function getAvatar()
    {
        //to keep the avarter same as one user

        $firstCharacter = $this->email[0] ;

        $integerToUse  =is_numeric($firstCharacter) ?  ord($firstCharacter) - 21 : ord(strtolower($this->email[0])) - 96;;
        // $randomInt = rand(1,36);        

        return 'https://www.gravatar.com/avatar/'
            .md5($this->email)
            .'?s=200'
            . '&d=https://s3.amazonaws.com/laracasts/images/forum/avatars/default-avatar-'. $integerToUse.'.png';
    }


    public function isAdmin()
    {
        return in_array($this->email,['adamhut@gmail.com']);
    }

}
