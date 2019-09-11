<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Stores extends Model {

  use SoftDeletes;
  
  protected $table = 'stores';
  
  protected $fillable = [

    'name',

  ];

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}