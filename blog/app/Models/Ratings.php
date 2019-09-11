<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ratings extends Model {

  use SoftDeletes;
  
  protected $table = 'ratings';
  
  protected $fillable = [

    'note',
    'description'

  ];

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}