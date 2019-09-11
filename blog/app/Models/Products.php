<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Products extends Model {

  use SoftDeletes;
  
  protected $table = 'products';
  
  protected $fillable = [

    'name',
    'price',

  ];

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}