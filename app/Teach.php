<?php

namespace App;

use App\Bid;
use App\Hire;
use App\Offer;
use Illuminate\Database\Eloquent\Model;

class Teach extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'title', 'benefits', 'attachments', 'summary', 'date', 'fee', 'location','budget' , 'type'
  ];


  protected $casts = [
    'benefits' => 'array',
    'attachments'  => 'array'
  ];

  protected $table = 'teaches';

  protected static function boot() {
       parent::boot();

       static::deleting(function($gig) {
            $gig->enrolls()->delete();
            // do the rest of the cleanup...
       });
   }

  public function enrolls()
  {

    return $this->hasMany(Enroll::class , 'teach_id');
  }

}
