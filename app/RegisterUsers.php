<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class RegisterUsers extends Model
{
     protected $fillable = [
        'name', 'email','number', 'password',
    ];
}
