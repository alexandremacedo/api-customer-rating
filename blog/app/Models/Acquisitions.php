<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Acquisitions extends Model {

  use SoftDeletes;
  
  protected $table = 'acquisitions';
  
  protected $fillable = [

    'payment-type'

  ];

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}