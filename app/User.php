<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\Types;
use App\Media;
use App\Payment;
use App\Gigs;
use App\Teach;
use App\Conversation;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'first_name', 'last_name', 'email', 'password', 'confirmation_code' , 'confirmed' , 'type' , 'subscribed'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token', 'confirmation_code' , 'confirmed'
    ];

    protected $with = ['connects.user'];


    public function scopeNotAdmins($query)
    {

      return $query->where('type' , '!=' , 3);
    }
    public function type()
    {

      return $this->hasOne(Types::class , 'id' , 'type');
    }

    public function gigs()
    {

      return $this->hasMany(Gigs::class , 'user_id' , 'id');
    }

    public function media()
    {

      return $this->hasMany(Media::class , 'user_id');
    }

    public function teaches()
    {

      return $this->hasMany(Teach::class , 'user_id');
    }

    public function payments()
    {

      return $this->hasMany(Payment::class , 'user_id')->orderBy('created_at' , 'DESC')->get();
    }

    public function conversations()
    {

      return $this->hasMany(Conversation::class , 'user_id')->get();
    }

    public function connects()
    {

      return $this->hasMany(Connects::class , 'user_id');
    }
    public function connectsTo()
    {

      return $this->hasMany(Connects::class , 'connect_to');
    }

}
