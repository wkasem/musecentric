<?php

namespace App;

use App\User;
use App\Messages;
use Illuminate\Database\Eloquent\Model;

class Conversation extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'other_id','conversation_id'
    ];

    protected $table = 'conversations';

    protected $with = [
      'messages',
      'user',
      'other'
    ];
    protected static function boot() {
         parent::boot();

         static::deleting(function($gig) {
              $gig->messages()->delete();
              // do the rest of the cleanup...
         });
     }
    public function messages()
    {

      return $this->hasMany(Messages::class , 'conversation_id' , 'conversation_id');
    }

    public function user()
    {

      return $this->hasOne(User::class , 'id' , 'user_id');
    }

    public function other()
    {

      return $this->hasOne(User::class , 'id' , 'other_id');
    }


}
