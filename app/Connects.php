<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Connects extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'connect_to'
  ];

  protected $table = 'user_connects';

  public function user()
  {

    return $this->hasOne(User::class ,'id' , 'connect_to');
  }
}
