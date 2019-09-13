<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Stores;

class Contributors extends Model {

  use SoftDeletes;
  
  protected $table = 'contributors';
  
  protected $fillable = [

    'name',
    'email',
    'store_id'

  ];

  public function stores()
  {
    return $this->hasMany(Stores::class);
  } 

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}