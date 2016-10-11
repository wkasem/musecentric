<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
  /**
   * The attributes that are mass assignable.
   *
   * @var array
   */
  protected $fillable = [
      'user_id', 'media_name', 'media_src'
  ];


  protected $table = 'user_media';

  public function extension()
  {
    
    return pathinfo($this->media_src , PATHINFO_EXTENSION);
  }
}
