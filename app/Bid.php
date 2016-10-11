<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Bid extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'gig_id', 'cover_letter', 'budget', 'user_id'
    ];

    protected $table = 'gig_bids';

    protected $with = ['user'];

    public function user()
    {

      return $this->hasOne(User::class , 'id', 'user_id');
    }

}
