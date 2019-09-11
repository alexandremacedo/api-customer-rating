<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model {

  protected $table = 'clients';

  protected $fillable = [

    'name',
    'email',
    'phone',
    'cpf',
    'date'

  ];

  protected $casts = [
    'date' => 'Timestamp'
  ];

  public $timestamps = false;

  
  
}