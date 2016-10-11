<?php

namespace App;

use App\Bid;
use App\User;
use App\Gigs;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{

  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'by_id', 'user_id','bid_id'
  ];
  protected $table = 'gig_offer';

  protected $with = ['gig' , 'user' , 'bid'];


  public function gig()
  {

    return $this->belongsTo(Gigs::class ,'gig_id');
  }

  public function byUser()
  {

    return $this->belongsTo(User::class ,'by_id');
  }

  public function user()
  {

    return $this->belongsTo(User::class ,'user_id');
  }

  public function bid()
  {

    return $this->belongsTo(Bid::class ,'bid_id');
  }


}
