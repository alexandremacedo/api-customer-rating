<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Transactions;
use App\Models\Ratings;

class Clients extends Model {

  use SoftDeletes;
  
  protected $table = 'clients';
  
  protected $fillable = [

    'name',
    'email',
    'phone',
    'cpf'

  ];

  protected $dates = ['deleted_at'];

  public function transactions()
  {
      return $this->hasMany(Transactions::class);
  }  

  public function ratings()
  {
      return $this->hasMany(Ratings::class);
  } 

  
  
}