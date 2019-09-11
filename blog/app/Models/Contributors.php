<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contributors extends Model {

  use SoftDeletes;
  
  protected $table = 'contributors';
  
  protected $fillable = [

    'name',
    'email',
    'phone',
    'cpf',

  ];

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}