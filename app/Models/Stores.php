<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Contributors;

class Stores extends Model {

  use SoftDeletes;
  
  protected $table = 'stores';
  
  protected $fillable = [

    'name',

  ];

  public function contributor()
  {
      return $this->hasMany(Contributors::class);
  }  

  protected $dates = ['deleted_at'];
  
}