<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Clients;
use App\Models\Contributors;
use App\Models\Ratings;

class Transactions extends Model {

  use SoftDeletes;
  
  protected $table = 'transactions';
  
  protected $fillable = [

    'payment_amount',
    'created_at',
    'client_id',
    'contributor_id'

  ];

  public function clients()
  {
      return $this->hasOne(Clients::class);
  }  

  public function contributors()
  {
      return $this->hasOne(Contributors::class);
  } 

  public function ratings()
  {
      return $this->hasMany(Ratings::class);
  } 

  // protected $casts = ['created_at' => 'Timestamp'];

  public $timestamps = false;
  
}