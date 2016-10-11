<?php

namespace App;

use App\User;
use App\Gigs;
use Illuminate\Database\Eloquent\Model;

class Hire extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'gig_id', 'user_id'
  ];

  protected $table = 'gig_hire';

  protected $primaryKey = 'gig_id';

  protected $with = ['user'];

  public function user()
  {

    return $this->hasOne(User::class , 'id', 'user_id');
  }
  public function gig()
  {

    return $this->belongsTo(Gigs::class , 'gig_id', 'id');
  }
}
