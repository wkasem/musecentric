<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Enroll extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'teach_id', 'cover_letter', 'budget', 'user_id'
  ];

    protected $table = 'teach_enroll';

    protected $with = ['user'];

    public function user()
    {

      return $this->hasOne(User::class , 'id', 'user_id');
    }

}
