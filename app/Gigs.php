<?php

namespace App;

use App\Bid;
use App\Hire;
use App\Offer;
use Illuminate\Database\Eloquent\Model;

class Gigs extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'title', 'requirements', 'attachments', 'summary', 'date', 'fee', 'location','budget'
  ];


  protected $casts = [
    'requirements' => 'array',
    'attachments'  => 'array'
  ];

  protected $table = 'gigs';

  protected static function boot() {
       parent::boot();

       static::deleting(function($gig) {
            $gig->hire()->delete();
            $gig->bids()->delete();
            $gig->offer()->delete();
            // do the rest of the cleanup...
       });
   }

  public function bids()
  {

    return $this->hasMany(Bid::class , 'gig_id');
  }

  public function hire()
  {

    return $this->hasOne(Hire::class , 'gig_id');
  }

  public function offer()
  {

    return $this->hasOne(Offer::class , 'gig_id');
  }
}
