<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transactions;


class Ratings extends Model {

  use SoftDeletes;
  
  protected $table = 'ratings';
  
  protected $fillable = [

    'grade',
    'description',
    'transaction_id'

  ];

  public function transactions()
  {
      return $this->hasOne(Transactions::class);
  }  

  protected $dates = ['deleted_at'];

  public $timestamps = true;
  
}